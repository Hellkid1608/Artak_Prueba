<?php
	class security{
		var $prefix;
		var $conn;
		function security($dbf, $page_type){
			$this -> conn = $dbf;
			$table = "users";
			if(isset($_SESSION['user_id'])){
				$usertype = $this -> getValue("admin", $table, "id = ".$_SESSION['user_id']);
				if($page_type != "Public" || $usertype != "Admin"){
					if($usertype != 1 && $usertype != 0){
						echo "Brecha de Seguridad";
						exit();
						}
					elseif($page_type != "Public" && $page_type != "Admin" && $page_type != "Operator"){
						echo "Brecha de seguridad";
						exit();
						}
					elseif($usertype != 1 && $page_type == "Admin"){
						echo "Debes ser administrador para ver esta página";
						exit();
						}
					}
				}
			}

		function isLoggedIn(){
			if(isset($_SESSION['user_id'])){
				$table = "users";
				$num = $this -> getValue("COUNT(*)", $table, "id = ".$_SESSION['user_id']);
				if($num == 1){
					return true;
					}
				return false;
				}
			return false;
			}

		function checkLogin($username, $password){
			$table = "users";
			$num = $this -> getValue("COUNT(*)", $table, "username = '".$username."' AND encrypted_password	 = '".hash('haval256,5', $password)."'");
			if($num == 1){
				return true;
				}
			return false;
			}

		function getValue($field, $table, $where){
                        $select = "SELECT ".$field." FROM ".$table;
                        if($where != NULL && $where != "" && $where != FALSE){
                                $select .= " WHERE ".$where;
                                }
//                      echo $select;
                        $result = mysqli_query($this -> conn -> conn, $select) or die(mysqli_error($this -> conn -> conn));
                        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                        if($row !== false){
                                return $row[$field];
                                }
                        else{
                                return false;
                                }
                        return false;
                        }

		function validateString($dato){
			$string = mysqli_real_escape_string($this -> conn -> conn, $dato);
			$data = trim($string);
			$datos = str_ireplace("script", "escripte", $data);
			$dato = str_ireplace("style", "estilo", $datos);
			return $dato;
			}
		}
?>
