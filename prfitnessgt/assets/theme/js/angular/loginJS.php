<?php
echo "
    var app = angular.module('login', []);
    app.controller('ctrlLogin', ['\$scope', '\$location', '\$http', function(\$scope, \$location, \$http) {
        // console.log(login);
        \$scope.show_error = false;
        \$scope.error = '';
        \$scope.data = {};
        \$scope.loggearse = function(login) {
            if (login != undefined) {
                if (login.usuario != undefined && login.usuario.trim() != '' && login.clave != undefined && login.clave.trim() != '') {
                    //      console.log(login) //borrar
                    \$http({
                        method: 'post',
                        url: '".  ROOT_SYS . "/revisar_logueo',
                        data: login
                    }).then(function success(rs) {
                        //console.log(rs);
                        if (rs.data === 'done') {
                            \$scope.error = '';
                            \$scope.show_error = false;
                            
                            window.location.href = '".  ROOT_SYS ."/dashboard';
                        } else {
                            \$scope.show_error = true;
                            \$scope.error = rs.data;
                        }
                    }, function error(rs) {
                        \$scope.error = 'error DB .js line 29';
                    });

                } else {
                    \$scope.error = 'debes llenar los datos que se te piden';
                }
            } else {
                /* form's error */
                \$scope.error = 'no has llenado ningún campo';
            }
        };

    }]);
";
