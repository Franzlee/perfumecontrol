<?php
/**
 *
 */
class crud
{
  //------------------------------CRUD PARA EMPLEADO---------------------
  public function obtenDatosEmple($idemp){
	require 'conexion.php';
	$sql = $con->query("SELECT * FROM empleado WHERE id_emp = '$idemp' ");
	$ver = $sql->fetch_row();
	$datos = array('idempphp'=>$ver[0],
					'nomempphp'=>$ver[1],
					'apempphp'=>$ver[2],
					'sexempphp'=>$ver[3],
					'fnempphp'=>$ver[4],
					'ndempphp'=>$ver[5],
					'dirempphp'=>$ver[6],
					'fonempphp'=>$ver[7],
					'emempphp'=>$ver[8],
					'idcgephp'=>$ver[9],
					'estadoemp'=>$ver[10],
					'accempphp'=>$ver[11],
					'pasempphp'=>$ver[12]);
	return $datos;
	}
  public function deleteEmple($idemp){
		require 'conexion.php';
		$sql = $con->query("DELETE FROM empleado WHERE id_emp = '$idemp' ");
		return $sql;
	}

  //------------------------------CRUD PARA GASTOS --------------------
  public function ReadGastos($idgto){
		require 'conexion.php';
		$sql = $con->query("SELECT * FROM gasto WHERE id_gasto= '$idgto' ");
		$ver = $sql->fetch_row();
		$datos = array('idgtophp'=>$ver[0],
						'precioGasto'=>$ver[1],
						'fechaGasto'=>$ver[2],
						'tipoGasto'=>$ver[3],
						'empleGasto'=>$ver[4]);
		return $datos;
	}
  public function DeleteGastos($idgto){
			require 'conexion.php';
			$sql = $con->query("DELETE FROM gasto WHERE id_gasto = '$idgto' ");
			return $sql;
	}
  //------------------------- CRUD PARA PRODUCTO --------------------------
  public function readDateProd($idprod){
		require 'conexion.php';
		$sql = $con->query("SELECT * FROM producto WHERE id_prod = '$idprod' ");
		$datoProd = $sql->fetch_row();
		$datos = array('ProdId' => $datoProd[0],
						'ProdCodig'=>$datoProd[1],
						'ProdNomb'=>$datoProd[2],
						'ProdPrecio'=>$datoProd[3],
						'ProdStock'=>$datoProd[4],
						'ProdMarca'=>$datoProd[5]);
		return $datos;
	}
  public function deleteProducto($idprod){
		require 'conexion.php';
		$sql = $con->query("DELETE FROM producto WHERE id_prod = '$idprod' ");
		return $sql;
	}
  //------------------------- CRUD PARA PROVEEDOR -----------------------
  public function readDatosProveedor($idprov){
		require 'conexion.php';
		$sql = $con->query("SELECT * FROM proveedor WHERE id_prov = '$idprov' ");
		$verprov = $sql->fetch_row();
		$datos = array('idprovphp'=>$verprov[0],
							'rsprovphp'=>$verprov[1],
							'scprovphp'=>$verprov[2],
							'tdprovphp'=>$verprov[3],
							'ndprovphp'=>$verprov[4],
							'dirprovphp'=>$verprov[5],
							'fonprovphp'=>$verprov[6],
							'emailprovphp'=>$verprov[7],
							'urlprovphp'=>$verprov[8]);
		return $datos;
	}
  public function deleteProveedor($idprov){
		require 'conexion.php';
		$sql = $con->query("DELETE FROM proveedor WHERE id_prov = '$idprov' ");
		return $sql;
	}
  //------------------------ PARA CLIENTE CRUD ------------------------------
  public function readDatosCliente($idcli){
		require 'conexion.php';
		$sql = $con->query("SELECT id_cli,nom_cli,ape_cli,doc_cli,num_cli,dir_cli,telf_cli,email_cli FROM cliente WHERE id_cli='$idcli'");
		$vercli = $sql->fetch_row();
		$datos = array('idcliphp'=> $vercli[0],
        						'nomcliphp'=>$vercli[1],
        						'apecliphp'=>$vercli[2],
        						'tdcliphp'=>$vercli[3],
        						'ndcliphp'=>$vercli[4],
        						'dircliphp'=>$vercli[5],
        						'fnocliphp'=>$vercli[6],
        						'mailcliphp'=>$vercli[7]);
		return $datos;
	}
  public function deleteCliente($idcli){
		require 'conexion.php';
		$sql = $con->query("DELETE FROM cliente WHERE id_cli = '$idcli' ");
		return $sql;
	}
  //------------------------ PARA VENTAS CRUD ------------------------------
  public function createFolioVenta(){
		require 'conexion.php';
		$sql = $con->query("SELECT id_venta FROM venta GROUP BY id_venta DESC ");
		$result = $sql->fetch_row();
		$id = $result[0];
		if ($id=="" or $id==null or $id==0) {
			return 1;
		}else{
			return $id + 1;
		}
	}
  public function createNewVenta(){
		require 'conexion.php';
		date_default_timezone_set('America/Lima');
		$fechaVenta = date('Y-m-d');
		$empleVenta=$_SESSION['loginPat']['id_emp'];
		$idVenta = self::createFolioVenta();
		$datos = $_SESSION['ProductoVentaTemp'];
		$r=0;
		for ($i=0; $i < count($datos) ; $i++) {
			$d=explode("||", $datos[$i]);
			$sql=$con->query("INSERT INTO venta (id_venta,
                														id_prod,
                														id_cli,
                														id_emp,
                														fecha_venta,
                														cant_venta,
                														descto_venta)
              								VALUES ('$idVenta',
                  										'$d[2]',
                  										'$d[0]',
                  										'$empleVenta',
                  										'$fechaVenta',
                  										'$d[7]',
                  										'$d[8]') ");
			$r = $r + $sql;
			self::updateStock($d[2],$d[7]);
		}
		return $r;
	}
  public function updateStock($idprod,$cant){
			require 'conexion.php';
			$sql = $con->query("SELECT stock_prod FROM producto WHERE id_prod='$idprod' ");
			$result = $sql->fetch_row();
			$stockProd = $result[0];
      //Actualizar
      $newStock = abs($stockProd - $cant);
      $sql = $con->query("UPDATE producto SET stock_prod='$newStock' WHERE id_prod='$idprod' ");
		}
    public function updateAddStock($idprod,$cant){
  			require 'conexion.php';
  			$sql = $con->query("SELECT stock_prod FROM producto WHERE id_prod='$idprod' ");
  			$result = $sql->fetch_row();
  			$stockProd = $result[0];
        //Actualizar
        $newStock = abs($stockProd + $cant);
        $sql = $con->query("UPDATE producto SET stock_prod='$newStock' WHERE id_prod='$idprod' ");
  		}
}
?>
