  1 ﻿/*
  2 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
  3 For licensing, see LICENSE.html or http://ckeditor.com/license
  4 */
  5 
  6 // Register a plugin named "sample".
  7 CKEDITOR.plugins.add( 'keystrokes',
  8 {
  9 	beforeInit : function( editor )
 10 	{
 11 		/**
 12 		 * Controls keystrokes typing in this editor instance.
 13 		 * @name CKEDITOR.editor.prototype.keystrokeHandler
 14 		 * @type CKEDITOR.keystrokeHandler
 15 		 * @example
 16 		 */
 17 		editor.keystrokeHandler = new CKEDITOR.keystrokeHandler( editor );
 18 
 19 		editor.specialKeys = {};
 20 	},
 21 
 22 	init : function( editor )
 23 	{
 24 		var keystrokesConfig	= editor.config.keystrokes,
 25 			blockedConfig		= editor.config.blockedKeystrokes;
 26 
 27 		var keystrokes			= editor.keystrokeHandler.keystrokes,
 28 			blockedKeystrokes	= editor.keystrokeHandler.blockedKeystrokes;
 29 
 30 		for ( var i = 0 ; i < keystrokesConfig.length ; i++ )
 31 			keystrokes[ keystrokesConfig[i][0] ] = keystrokesConfig[i][1];
 32 
 33 		for ( i = 0 ; i < blockedConfig.length ; i++ )
 34 			blockedKeystrokes[ blockedConfig[i] ] = 1;
 35 	}
 36 });
 37 
 38 /**
 39  * Controls keystrokes typing in an editor instance.
 40  * @constructor
 41  * @param {CKEDITOR.editor} editor The editor instance.
 42  * @example
 43  */
 44 CKEDITOR.keystrokeHandler = function( editor )
 45 {
 46 	if ( editor.keystrokeHandler )
 47 		return editor.keystrokeHandler;
 48 
 49 	/**
 50 	 * List of keystrokes associated to commands. Each entry points to the
 51 	 * command to be executed.
 52 	 * @type Object
 53 	 * @example
 54 	 */
 55 	this.keystrokes = {};
 56 
 57 	/**
 58 	 * List of keystrokes that should be blocked if not defined at
 59 	 * {@link keystrokes}. In this way it is possible to block the default
 60 	 * browser behavior for those keystrokes.
 61 	 * @type Object
 62 	 * @example
 63 	 */
 64 	this.blockedKeystrokes = {};
 65 
 66 	this._ =
 67 	{
 68 		editor : editor
 69 	};
 70 
 71 	return this;
 72 };
 73 
 74 (function()
 75 {
 76 	var cancel;
 77 
 78 	var onKeyDown = function( event )
 79 	{
 80 		// The DOM event object is passed by the "data" property.
 81 		event = event.data;
 82 
 83 		var keyCombination = event.getKeystroke();
 84 		var command = this.keystrokes[ keyCombination ];
 85 		var editor = this._.editor;
 86 
 87 		cancel = ( editor.fire( 'key', { keyCode : keyCombination } ) === true );
 88 
 89 		if ( !cancel )
 90 		{
 91 			if ( command )
 92 			{
 93 				var data = { from : 'keystrokeHandler' };
 94 				cancel = ( editor.execCommand( command, data ) !== false );
 95 			}
 96 
 97 			if  ( !cancel )
 98 			{
 99 				var handler = editor.specialKeys[ keyCombination ];
100 				cancel = ( handler && handler( editor ) === true );
101 
102 				if ( !cancel )
103 					cancel = !!this.blockedKeystrokes[ keyCombination ];
104 			}
105 		}
106 
107 		if ( cancel )
108 			event.preventDefault( true );
109 
110 		return !cancel;
111 	};
112 
113 	var onKeyPress = function( event )
114 	{
115 		if ( cancel )
116 		{
117 			cancel = false;
118 			event.data.preventDefault( true );
119 		}
120 	};
121 
122 	CKEDITOR.keystrokeHandler.prototype =
123 	{
124 		/**
125 		 * Attaches this keystroke handle to a DOM object. Keystrokes typed
126 		 ** over this object will get handled by this keystrokeHandler.
127 		 * @param {CKEDITOR.dom.domObject} domObject The DOM object to attach
128 		 *		to.
129 		 * @example
130 		 */
131 		attach : function( domObject )
132 		{
133 			// For most browsers, it is enough to listen to the keydown event
134 			// only.
135 			domObject.on( 'keydown', onKeyDown, this );
136 
137 			// Some browsers instead, don't cancel key events in the keydown, but in the
138 			// keypress. So we must do a longer trip in those cases.
139 			if ( CKEDITOR.env.opera || ( CKEDITOR.env.gecko && CKEDITOR.env.mac ) )
140 				domObject.on( 'keypress', onKeyPress, this );
141 		}
142 	};
143 })();
144 
145 /**
146  * A list of keystrokes to be blocked if not defined in the {@link CKEDITOR.config.keystrokes}
147  * setting. In this way it is possible to block the default browser behavior
148  * for those keystrokes.
149  * @type Array
150  * @default (see example)
151  * @example
152  * // This is actually the default value.
153  * config.blockedKeystrokes =
154  * [
155  *     CKEDITOR.CTRL + 66 /*B*/,
156  *     CKEDITOR.CTRL + 73 /*I*/,
157  *     CKEDITOR.CTRL + 85 /*U*/
158  * ];
159  */
160 CKEDITOR.config.blockedKeystrokes =
161 [
162 	CKEDITOR.CTRL + 66 /*B*/,
163 	CKEDITOR.CTRL + 73 /*I*/,
164 	CKEDITOR.CTRL + 85 /*U*/
165 ];
166 
167 /**
168  * A list associating keystrokes to editor commands. Each element in the list
169  * is an array where the first item is the keystroke, and the second is the
170  * name of the command to be executed.
171  * @type Array
172  * @default (see example)
173  * @example
174  * // This is actually the default value.
175  * config.keystrokes =
176  * [
177  *     [ CKEDITOR.ALT + 121 /*F10*/, 'toolbarFocus' ],
178  *     [ CKEDITOR.ALT + 122 /*F11*/, 'elementsPathFocus' ],
179  *
180  *     [ CKEDITOR.SHIFT + 121 /*F10*/, 'contextMenu' ],
181  *
182  *     [ CKEDITOR.CTRL + 90 /*Z*/, 'undo' ],
183  *     [ CKEDITOR.CTRL + 89 /*Y*/, 'redo' ],
184  *     [ CKEDITOR.CTRL + CKEDITOR.SHIFT + 90 /*Z*/, 'redo' ],
185  *
186  *     [ CKEDITOR.CTRL + 76 /*L*/, 'link' ],
187  *
188  *     [ CKEDITOR.CTRL + 66 /*B*/, 'bold' ],
189  *     [ CKEDITOR.CTRL + 73 /*I*/, 'italic' ],
190  *     [ CKEDITOR.CTRL + 85 /*U*/, 'underline' ],
191  *
192  *     [ CKEDITOR.ALT + 109 /*-*/, 'toolbarCollapse' ]
193  * ];
194  */
195 CKEDITOR.config.keystrokes =
196 [
197 	[ CKEDITOR.ALT + 121 /*F10*/, 'toolbarFocus' ],
198 	[ CKEDITOR.ALT + 122 /*F11*/, 'elementsPathFocus' ],
199 
200 	[ CKEDITOR.SHIFT + 121 /*F10*/, 'contextMenu' ],
201 	[ CKEDITOR.CTRL + CKEDITOR.SHIFT + 121 /*F10*/, 'contextMenu' ],
202 
203 	[ CKEDITOR.CTRL + 90 /*Z*/, 'undo' ],
204 	[ CKEDITOR.CTRL + 89 /*Y*/, 'redo' ],
205 	[ CKEDITOR.CTRL + CKEDITOR.SHIFT + 90 /*Z*/, 'redo' ],
206 
207 	[ CKEDITOR.CTRL + 76 /*L*/, 'link' ],
208 
209 	[ CKEDITOR.CTRL + 66 /*B*/, 'bold' ],
210 	[ CKEDITOR.CTRL + 73 /*I*/, 'italic' ],
211 	[ CKEDITOR.CTRL + 85 /*U*/, 'underline' ],
212 
213 	[ CKEDITOR.ALT + ( CKEDITOR.env.ie || CKEDITOR.env.webkit ? 189 : 109 ) /*-*/, 'toolbarCollapse' ],
214 	[ CKEDITOR.ALT + 48 /*0*/, 'a11yHelp' ]
215 ];
216 
217 /**
218  * Fired when any keyboard key (or combination) is pressed into the editing area.
219  * @name CKEDITOR.editor#key
220  * @event
221  * @param {Number} data.keyCode A number representing the key code (or
222  *		combination). It is the sum of the current key code and the
223  *		{@link CKEDITOR.CTRL}, {@link CKEDITOR.SHIFT} and {@link CKEDITOR.ALT}
224  *		constants, if those are pressed.
225  */
226 