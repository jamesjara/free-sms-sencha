<?php
function
create_login($id,$url,$title,$image,$username_title,$username_empty,$password_title,$password_empty,$loginButton_title,$waitTitle_title,$waitMsg_title,$ok_login_title,$ok_login_msg,$ok_login_redirect,$fail_login_title, $fail_login_msg ,$fail_login_title2 , $fail_login_msg2 ,$debug)
{
	//init login
	$login  = " Ext.QuickTips.init();Ext.form.Field.prototype.msgTarget = 'side';   ";
	//create panel login with unique ID
	$login .= " var ".$id."_login = new Ext.FormPanel({ ";
	//login panel URL
	$login .= " url:'".$url."', ";
	//login panel title
	$login .= " title:'".$title."', ";
	//login panel propertis
	$login .= " autoHeight: true,labelWidth:80,frame:true, defaultType:'textfield',monitorValid:true,buttonAlign: 'center',";
	//login Attributes init
	$login .= " items:[";
	//login Image field
	//$login .= " { xtype : 'fieldset',autoHeight : true,html : '<img  src=".$image." />'";
	//login Attributes fields
	//$login .= " },{ ";
	$login .= " { ";
	//login field USERNAME title
	$login .= " fieldLabel:'".$username_title."', ";
	//login field USERNAME properties
	$login .= " name:'loginUsername',allowBlank:false , blankText :'".$username_empty."' ";
	//NEXT FIELD//PARAMETRO OCULTO 
	$login .= " },{ xtype:'hidden',name:'A', value:'4' },{ ";	
	//login field PASSWORD title
	$login .= " fieldLabel:'".$password_title."', ";
	//login field PASSWORD properties
	$login .= " name:'loginPassword',inputType:'password',allowBlank:false , blankText :'".$password_empty."'  ";
	$login .= " }], ";
	//Login Button  Attributes
	$login .= "  buttons:[{ ";
	//Login Button  title
	$login .= " text:'".$loginButton_title."', ";
	//Login Button  Attributes
	$login .= " formBind: true, 	 ";
	//Login Button  Handler   IMPORTANT!!!
	//THIS SEND THE INFO TO THE WS
	$login .= " handler:function(){  ";
	$login .= $id."_login.getForm().submit({";
	//CONFIG SEND
	$login .= " method:'POST', ";
	//Login  Handler WaitTitle
	$login .= " waitTitle:'".$waitTitle_title."', ";
	//Login  Handler Waitmessage
	$login .= " waitMsg:'".$waitMsg_title."', ";
	//WS RESPONSE
	//Success Login
	$login .= "success:function(){ Ext.Msg.alert('".$ok_login_title."', '".$ok_login_msg."', function(btn, text){if (btn == 'ok'){var redirect = '".$ok_login_redirect."';window.location = redirect;}}); },";
	//Failure Login
	$login .= "failure:function(form, action){if(action.failureType == 'server'){obj = Ext.util.JSON.decode(action.response.responseText);Ext.Msg.alert('".$fail_login_title."', '".$fail_login_msg."');
}else{Ext.Msg.alert('".$fail_login_title2."', '".$fail_login_msg2."');
} }});}";
	//Login Button,panel  close
	$login .= "  }] }); ";
	//create window login with unique ID
	$login .= " var ".$id."_win = new Ext.Window({ ";
	//Window Properties
	$login .= " x:50 , y: 109,  autoHeight: true, layout:'fit',width:300,height:250,closable: false,resizable: false,plain: true,border: false, ";										//Window Items
	$login .= "  items: [".$id."_login] ";
	//Login Windows close and show
	$login .= "  }); ".$id."_win.show(); ";


	if ($debug == "true"){
		//print MODULE IN NORMAL MODE
		echo utf8_decode("<SCRIPT>Ext.onReady(function(){".$login." });</SCRIPT>");
	}else
	if ($debug == "false"){		
		//print MODULE IN SECURE MODE
		$var = utf8_encode(" Ext.onReady(function(){ ".$login." }); ");
  		$packer = new JavaScriptPacker($var,'Normal', 'true', 'true');
  		$packed = $packer->pack();
		echo ("<SCRIPT type=\"text/javascript\"> ".$packed." </SCRIPT>");
	}
}
?>