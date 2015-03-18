<?php 

class Procesos_Nomina extends CI_Model {

	
    function buscar_retenciones($semana,$year,$id_empleado,$fecha_ini,$fecha_fin)
    {
        $this->db->where('week',$semana);
        $this->db->where('year',$year);
        $this->db->where('id_empleado',$id_empleado);
        $this->db->limit(1);
        $query = $this->db->get('nomina_retenciones');
        
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            if($semana > 1)
            {
                $this->db->where('year',$year);
                $this->db->where('id_empleado',$id_empleado);
                $this->db->limit(1);
                $this->db->order_by('week','desc');
                $query_lastWeek = $this->db->get('nomina_retenciones');
                
                $row = $query_lastWeek->row();
                
                $data = array(
                'week' => $semana ,
                'year' => $year ,
                'id_empleado' => $id_empleado,
                'fecha_inicio' => $fecha_ini,
                'fecha_final' => $fecha_fin,
                'saldo_anterior' => $row->saldo_actual,
                'saldo_actual' => $row->saldo_actual
                
            );
                
            }
            else
            {
                $data = array(
                'week' => $semana ,
                'year' => $year ,
                'id_empleado' => $id_empleado,
                'fecha_inicio' => $fecha_ini,
                'fecha_final' => $fecha_fin
                
            );
                
            }

            $this->db->insert('nomina_retenciones',$data);
            
            
        }
        
    }
    
    function datos_empleado($id_empleado)
    {
        $this->db->where('idEmpleado',$id_empleado);
        $this->db->limit(1);
        $query = $this->db->get('empleados');
        
        return $query->row();
    }
    
    function actualizar($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('nomina_retenciones',$data);
    }
    
    function orden($id)
    {
        $this->db->select_sum('rel_monto_servicios.piezas');
        $this->db->from('orden');
        $this->db->join('rel_monto_servicios', 'rel_monto_servicios.id_orden = orden.idOrdenes');
        $this->db->where('orden.clave',$id);
        $query = $this->db->get();
        
        $result = $query->row();
        
        $this->db->where('clave', $id);
        $this->db->update('orden', array('piezas' => $result->piezas)); 
        
        $this->db->select('*');
        $this->db->from('orden');
        $this->db->where('orden.clave',$id);
        $this->db->join('vehiculo', 'orden.idVehiculo = vehiculo.idVehiculo');
        
        $query2 = $this->db->get();
        
        return json_encode($query2->row());
    }
    
     function pintura($id,$semana,$year)
    {
        $this->db->select('*');
        $this->db->where('nomina_pintura.year',$year);
        $this->db->where('nomina_pintura.week',$semana);
        $this->db->where('nomina_pintura.id_empleado',$id);
        $this->db->from('nomina_pintura');
        $this->db->join('orden','orden.idOrdenes = nomina_pintura.id_orden');
        $this->db->join('vehiculo','vehiculo.idVehiculo = orden.idVehiculo');
        $query = $this->db->get();
        
        return $query;
    }
    
    function buscar($id,$tabla)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from($tabla);
        $query = $this->db->get();
        
        return $query->row();
    } 
    
    
    function buscar_join($id,$tabla,$tabla2,$on)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from($tabla);
        $this->db->join($tabla2,$on);
        $this->db->join('vehiculo','vehiculo.idVehiculo = orden.idVehiculo');
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function retenciones($semana,$year,$id_empleado)
    {
        $this->db->select('*');
        $this->db->where('week',$semana);
        $this->db->where('year',$year);
        $this->db->where('id_empleado',$id_empleado);
        $this->db->from('nomina_retenciones');
        $query = $this->db->get();
        
        return $query->row();
    }

    function descuentos($id)
    {
        $this->db->select('*');
        $this->db->where('id_retencion',$id);
        $this->db->from('nomina_retenciones_descuentos');
        $query = $this->db->get();

        return $query;
    }
    
    

}

?>
