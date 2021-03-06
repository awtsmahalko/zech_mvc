<?php
	function FM_INSERT_QUERY($table_name, $form_data , $last_id = 'N'){
		$fields = array_keys($form_data);

		$sql = "INSERT INTO ".$table_name."
		(`".implode('`,`', $fields)."`)
		VALUES('".implode("','", $form_data)."')";

		$return_insert = mysql_query($sql)or die(mysql_error());
		$lastID = mysql_insert_id();

		$ret_ = ($last_id == 'Y')?$lastID:1;
		return ($return_insert)?$ret_:0;
	}

	function FM_INSERT_QUERY_SELECT($table_name, $select_table, $form_data , $where_clause){
		$fields = array_keys($form_data);
		$inject = ($where_clause=='')?"":"WHERE $where_clause";
		$sql = "INSERT INTO ".$table_name." (`".implode('`,`', $fields)."`) SELECT ".implode(",", $form_data)." FROM $select_table $inject";
		$return_insert = mysql_query($sql);
		return ($return_insert)?1:0;
	}

	function FM_SELECT_QUERY($type , $table , $params = ''){
		$inject = ($params=='')?"":"WHERE $params";
		$select_query = mysql_query("SELECT $type FROM $table $inject")or die(mysql_error());
		$fetch = mysql_fetch_array($select_query);
		return $fetch;
	}

	function FM_SELECT_LOOP_QUERY($type , $table , $params = ''){
		$inject = ($params=='')?"":"WHERE $params";
		$fetch = mysql_query("SELECT $type FROM $table $inject")or die(mysql_error());
		while ($row = mysql_fetch_array($fetch)) {
			$data[] = $row;
		}
		return $data;
	}

	function FM_UPDATE_QUERY($table_name, $form_data, $where_clause=''){
		$whereSQL = '';
		if(!empty($where_clause)){
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
				$whereSQL = " WHERE ".$where_clause;
			}else{
				$whereSQL = " ".trim($where_clause);
			}
		}
		$sql = "UPDATE ".$table_name." SET ";
		$sets = array();
		foreach($form_data as $column => $value)
		{
			$sets[] = "`".$column."` = '".$value."'";
		}
		$sql .= implode(', ', $sets);
		$sql .= $whereSQL;

		$return_query = mysql_query($sql);
		return ($return_query)?1:0;
	}

	function FM_DELETE_QUERY($table_name, $where_clause=''){
		$whereSQL = '';
		if(!empty($where_clause)){
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
				$whereSQL = " WHERE ".$where_clause;
			}else{
				$whereSQL = " ".trim($where_clause);
			}
		}
		$sql = "DELETE FROM ".$table_name.$whereSQL;
		$return_delete = mysql_query($sql);
		return ($return_delete)?1:0;
	}

	function FM_QUERY($query){
		$r = mysql_query($query);
		return ($r)?1:0;
	}

	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

	function sidebar_parent($active_li,$tree,$menu = 0){
		$menu_ = ($menu == 1)?"menu-open":"active";
		return in_array($active_li, $tree) ? $menu_  : '';
	}
	function sidebar_li($module_name,$li,$active_li, $icon = "fa-circle-o"){
		$is_active = ($active_li == $li)?'active':'';
		return "<li class='nav-item'>
			<a href='".BASE_PATH.APP_FOLDER."$li' class='nav-link $is_active'>
				<i class='nav-icon fa $icon'></i>
				<p>$module_name</p>
			</a>
		</li>";
	}

	function sidebar_ul($name,$icon_ = "fa-file-o"){
		return "<i class='nav-icon fa $icon_'></i><p>$name<i class='right fa fa-angle-left'></i></p>";
	}
?>