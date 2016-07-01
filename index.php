<?php
//Zero Key
$_zero_key_algorithm;
//Percentage Sign isEqualsTo 100101
if(!empty($_GET["cmd"])){
  $_string=$_GET["cmd"];
}elseif(empty($_GET["cmd"])){
  $_string="404";
}
//Message Encryption | Key to Key Decryption
function encode($_string){
  $_string=strip_tags($_string);
  $_string=htmlentities($_string);
  $_string=htmlspecialchars($_string);
  $_string=urldecode($_string);
  $_string=strtoupper($_string);
  $_range=range("A","Z");
  $_stack=array("A","L","R","E","S","G","T","Q","B");
  $_converts=array(4,1,2,3,5,6,7,9,8);
  $_tmp=array();
  $_delimiter=unpack("H*","%");
  foreach($_range as $_token => $_coin){
    if(is_string($_range[$_token])){
        $_hash=unpack("H*",$_range[$_token]);
        $_hashd=base_convert($_hash[1],16,2);
        array_push($_tmp,"0x".bin2hex(str_replace($_stack,$_converts,$_hashd)));
    }elseif(is_int($_range[$_token])){
      continue;
    }
  }
  $_string=str_replace($_range,$_tmp,$_string);
  $_string=preg_replace("/\s+/",base_convert($_delimiter[1],16,2),$_string);
  return($_string);
}

function decode($_string){
  $_string=preg_replace("/[^A-Za-z0-9\-]/","100101",$_string);

  $_range=range("A","Z");
  $_stack=array("A","L","R","E","S","G","T","Q","B");
  $_converts=array(4,1,2,3,5,6,7,9,8);
  $_tmp=array();

  foreach($_range as $_token => $_coin){
    if(is_string($_range[$_token])){
        $_hash=unpack("H*",$_range[$_token]);
        $_hashd=base_convert($_hash[1],16,2);
        array_push($_tmp,"0x".bin2hex(str_replace($_stack,$_converts,$_hashd)));
    }elseif(is_int($_range[$_token])){
      continue;
    }
  }
  $_string=str_replace($_tmp,$_range,$_string);
  $_string=strtolower($_string);
  $_string=explode("100101",$_string);
  $_string_t=array();
  foreach($_string as $_token => $_coin){
    $_string_t[]=ucfirst($_coin);
  }
  return(implode(" ",$_string_t));
}

$_title=decode(encode($_string));
$_drop=encode($_string);

if(!empty($_title)){
  $_title=$_title;
  $_drop=$_drop;
}elseif(empty($_title)){
  $_title="Filtered Query";
  $_drop="Filtered Query ( 404 )";
}

echo("<title>".$_title."</title>");
echo("<html style='Width:100vw;Height:100vh;Display:Inline-Block;Overflow:Hidden;White-Space:Nowrap;Word-Break:Break-All;Word-Wrap:Break-Word;Margin:0 Auto;Padding:0%;Border:None;Background-Color:Black;'><body style='Width:100%;Height:100%;Display:Inline-Flex;Overflow:Hidden;White-Space:Pre-Wrap;Word-Break:Break-All;Word-Wrap:Break-Word;Margin:0 Auto;Padding:0%;Border:None;Color:Red;Align-Items:Center;'><div style='Width:100%;Height:Auto;Text-Align:Center;Display:Inline-Block;'><a href='/' style='Width:26%;Margin:2%;Display:Inline-Block;Cursor:Pointer;Text-Decoration:None;Color:Green;'>".$_drop."</a><div style='Cursor:Pointer;'>&copy; Red Moon Project</div></div></body></html>");
//
?>
