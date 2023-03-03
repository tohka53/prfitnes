<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* La function @check_token  
* verifica la existencia de un token de ingreso 
* referente al usuario logueado.
* si el token existe tendrá acceso al sistema
* y a los modulos asignados según sus permisos.
*/

if ( ! function_exists('related_news'))
{
    function related_news($id_noticia, $anio, $id_target) {        
        $ci=& get_instance();
        /* verifica la existencia de una base de datos */
        if( $ci->db->database != ""){
			$tipo_noticia = "";
			$ci->db->select('a.id_target');
            $ci->db->from('tb_noticias a');
			$ci->db->join('tb_categorias_noticias b','b.id = a.id_tipo_noticia', 'inner');
			$ci->db->join('tb_periodos c','a.id_periodo = c.id', 'left');
			
            $ci->db->where("a.id =", $id_noticia);
			$ci->db->where("a.id_tipo_noticia", $id_target);
			//$ci->db->where("c.periodo =", $anio);			
			
			$query_target = $ci->db->get();			
			//print_r($query_target->result_array());
			
			if(!empty( $query_target->result_array() ) ){
				$dato = $query_target->result_array();
				$target = $dato[0]['id_target'];
			}else{
				return false;
			}
			
			/* se buscan las noticias relacionadas */
            $ci->db->select('
				*,
				a.id as id_noticia
			');
			
            $ci->db->from('tb_noticias a');
			$ci->db->join('tb_categorias_noticias b','b.id = a.id_tipo_noticia', 'inner');
			$ci->db->join('tb_periodos c','a.id_periodo = c.id', 'left');
			
			$ci->db->where_not_in("a.id ", $id_noticia);
            $ci->db->where("a.id_target =", $target);
			$ci->db->where("a.id_tipo_noticia", $id_target);
			//$ci->db->where("c.periodo =", $anio);
			$ci->db->where("a.status =", 1);
			$ci->db->limit(2);
			$ci->db->order_by('a.fecha_noticia DESC');
						
            $query = $ci->db->get();
			
            if(!empty($query->result_array())){
				$noticias = $query->result_array();
				$news = "";
				foreach($noticias as $noticia){ 
					
					$news .= '<div class="col-lg-12 col-xl-6">';
					$news .= '<div class="media p-t-10">';
					$news .= '<div class="media-left">';
					$news .= '<a class="img-card" href="'.base_url().'noticias_congreso/'.$noticia['id_noticia'].'/'.$noticia['periodo'].'/'.$noticia['id_tipo_noticia'].'">';
					$news .= '<img class="media-object m-r-10" style=""src="'.base_url().'assets/uploads/noticias/miniaturas/'.$noticia['miniatura'].'" alt="Generic placeholder image">';
					$news .= '</a>';
					$news .= '</div>';
					$news .= '<div class="media-body">';
					$news .= '<div class="company-name">';
					$news .= '<p><a href="#!">'. $noticia['titulo_noticia'] .'</a></p>';
					$news .= '<span class="text-muted f-14">'. $noticia['fecha_noticia'] .'</span></div>';
					$news .= '<p class="text-muted">';
					$news .= trim_text($noticia['contenido_noticia'], 100);
					$news .= '</p>';
					$news .= '</div>';
					$news .= '<span class="media-right label-main">';
					//echo '<label class="label bg-warning">Destacado</label>';
					$news .= '</span>';
					$news .= '</div>';
					$news .= '</div>';										
				}
				
				return $news;
            }else{
                return false;
            }
        }
    }  
			
}

