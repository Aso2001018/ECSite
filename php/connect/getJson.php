<?php
session_start();
require 'getDBSql.php';

class SearchSql{
public$data;
public$getstr;
public$mode;
public$fmode;
public function __construct($data,$getstr,$mode,$fmode){
  $this->data=$data;
  $this->getstr=$getstr;
  $this->mode=$mode;
  $this->fmode=$fmode;
}
public function addSql(&$_sql,&$_andflg){
if(!empty($_POST[$this->getstr])){
  switch($this->fmode) {
    case 1:
      if ($_andflg) {
        $_sql.=' AND ';
      }
      else {
        $_sql.=' WHERE ';
        $_andflg = true;
      }
          $_sql.=$this->data.' '.$this->mode.' '.$_POST[$this->getstr];    
          break;
        case 2:
          $_sql.=' ORDER BY ';
          $_sql.=$this->data.' '.$this->mode;
          break;
        case 3:
          if ($_andflg) {
            $_sql.=' AND ';
          }
          else {
            $_sql.=' WHERE ';
            $_andflg = true;
          }
          $_sql.='( ';
          for($i=0;$i<$_POST[$this->mode];$i++) {
            if($i!=0) {
              $_sql.=' OR ';
            }
            $_sql.=$this->data.' = '.$_POST[$this->getstr.'_'.$i];
          }
          $_sql.=' )';
          break;
      }
    }
  }
}
$sql = '';
if (!empty($_POST['table'])) {
  $sql.='SELECT * FROM '.$_POST['table'];
  if ($_POST['table']=='d_item') {
    $searchList = array(
      new SearchSql('price','minvalue','>=',1),
      new SearchSql('price','maxvalue','<=',1),
      new SearchSql('pc_cate_id','type','==',1),
      new SearchSql('os_id','os','=',1),
      new SearchSql('cpu_id','cpu','=',1),
      new SearchSql('memory_id','ram','=',1),
      new SearchSql('gpu_id','gpu','=',1),
      new SearchSql('ssd_id','ssd','=',1),
      new SearchSql('hdd_id','hdd','=',1),
      new SearchSql('price','price_asc','ASC',2),
      new SearchSql('price','price_desc','DESC',2),
      new SearchSql('reg_date','date_asc','ASC',2),
      new SearchSql('reg_date','date_desc','DESC',2),
      new SearchSql('item_name','name_asc','ASC',2),
      new SearchSql('item_code','code','list',3));
    $andflg = false;
    foreach ($searchList as $search) {
      $search->addSql($sql,$andflg);
    }
    $sql.=';';
  }
}
$rary = getDbSql($sql);
for($i = 0;$i<count($rary);$i++){
  $rary[$i]['isfav'] = false;
  for($n = 1; $n <= $_SESSION['fav_num']; $n++) {
    if ($rary[$i]['item_code'] == $_SESSION['fav_'.$n.'_item_code']) {
      $rary[$i]['isfav'] = true;
      break;
    }
  }
}
echo json_encode($rary);
endDbSql();
?>