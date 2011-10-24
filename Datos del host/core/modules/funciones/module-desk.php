<?php

//Crea el bosquejo del main   
function crear_sms_send($debug)
{
$sms_send = " 
		    Ext.QuickTips.init();
			Ext.form.Field.prototype.msgTarget = 'side';  
			
        //	MODULO CONTANCTO
        var HttpProxy_contacto = new Ext.data.HttpProxy({
            url: 'core/store/service.php',
            method: 'POST',
            api: {
                read: 'core/store/service.php?xaction=1',
                create: 'core/store/service.php?xaction=2',
                destroy: 'core/store/service.php?xaction=3'
            }
        });
        var contacto_store = new Ext.data.Store({
            autoLoad: true,
            proxy: HttpProxy_contacto,
            reader: new Ext.data.JsonReader(),
            baseParams: {
                A: '1'
            }
        });
        var ColumnModel_contacto = new Ext.grid.ColumnModel([{
            id: 'A',
            header: 'hash',
            dataIndex: 'A',
            hidden: true
        },{
            id: 'B',
            header: 'ID',
            dataIndex: 'B',
            hidden: true
        },
                           {
            id: 'C',
            header: 'Contacto',
            dataIndex: 'C',
            width: 130
        },
                           {
            id: 'D',
            header: 'Numero',
            dataIndex: 'D',
            width: 60
        },
                           {
            id: 'E',
            header: 'MegaID',
            dataIndex: 'E',
            hidden: true
        }
                           ]);
		
    var enviar_mensaje = new Ext.Action({
        text: 'Enviar Mensaje',
		bodyStyle : 'margin:5px 5px 5px 5px', 
        handler: function(){
			


	if( Ext.getCmp('tel').isValid()==true ){
			
				if( Ext.getCmp('mensaje').isValid()==true ){
				
				form_mensajes.form.submit({
url: 'core/store/service.php?xaction=2',
method: 'POST',
params: {A: '2' , numero: Ext.getCmp('tel').getValue() , mensaje:Ext.getCmp('mensaje').getValue() },
waitTitle: 'Enviando mensaje al servidor...',
waitMsg: 'En progreso.....',
						failure: function() {
						Ext.MessageBox.alert('Ocurrio un problema en el servidor', 'Intentelo de nuevo');
						},
						success: function() {
						Ext.MessageBox.alert('Felicidades!', 'El mensaje a sido enviado con exito');
						}
						});
				
				
				} else {
				Ext.MessageBox.alert('Error', 'Debes poner un mensaje correcto');
				};
	} else {
    Ext.MessageBox.alert('Error', 'Debes poner un numero celular correcto');
    };


        },
        iconCls: 'ready'
    });


        var form_mensajes = new Ext.FormPanel({  
            renderTo: 'sms',
            title: 'Enviar Mensaje',				  
			labelAlign : 'top',  
			frame : true,  
			bodyStyle : 'padding:5px 5px 0 0',  
			height: 210,
			monitorValid:true ,
      		bbar: ['->',enviar_mensaje],			
			items : [ {  
					 layout : 'column',  
					 width : 515, 					 
					 items : [ { 
							  columnWidth : 0.5,  
							  layout : 'form', 
							  items : [{
									   xtype : 'grid',
									   border : false,
									   cm: ColumnModel_contacto,
									   store: contacto_store,
									 //  viewConfig : {  forceFit : false, scrollOffset: 2},
									//   autoScroll: true,
									   loadMask: true,
									   stripeRows: true,
									   columnLines: true,
									 //  autoHeight: false,	
									 //  autoWidth : false,
									   height: 192,	
									   width : 200,	
									//  region: 'center',
									  boxMaxHeight : 192,	
									   bodyStyle : 'padding:0 10px 0px 0px',
									                       listeners: {
                        rowclick: function(g, index, ev) {

                            var rec = g.store.getAt(index);
                            Ext.getCmp('name').setValue(rec.get('C'));
                            Ext.getCmp('tel').setValue(rec.get('D'));
                        }
                    }
									   
									   }]    
							  },      
							  {         
							  columnWidth : 0.5,
							  layout : 'form', 							 
							  width : 290,
							  items : [{    
									   xtype : 'fieldset',
									   title : 'Mensaje',    
									   autoHeight : true, 
									   items : [{
					xtype: 'textfield',						
                    fieldLabel: 'Name',
                    name: 'name',
                    id: 'name',
					width: 100
												
												},                
												{
							selectOnFocus: true,													
                    fieldLabel: 'Celular',
                    name: 'tel',
                    id: 'tel',
                    xtype: 'numberfield',
                    blankText: 'El Celular es obligatorio!',
                    emptyText: 'El Celular',
                    allowBlank: false,
                    minLength: 8,
                    maxLength: 8,
                    invalidText: 'El Celular es obligatorio!',
                    minLengthText: 'El numero es invalido'
													},
													{
					selectOnFocus: true,	
                    fieldLabel: 'Mensaje',
                    xtype: 'textarea',
                    name: 'mensaje',
                    id: 'mensaje',
                  	width: 230,
                   	height: 40,
                    blankText: 'El mensaje es obligatorio!',
                    emptyText: 'El Mensaje',
                    maxLength: 116,
                    allowBlank: false,
                    maxLengthText: 'Has llegado al maximo de caracteres: 116',
                    invalidText: 'El Celular es obligatorio!',
					bodyStyle : 'padding:0 0 0 0'
														}]
			
									   }]
							  }]
					 }]
			}
											  
		);
		
		
		
		//MODULO DE AGENDA
		
var add_c_win;
var add_contactos = new Ext.Action({
        text: 'Agregar',
		bodyStyle : 'margin:5px 5px 5px 5px', 
        handler: function(){


add_c_win = new Ext.Window({
                closeAction:'hide',
                plain: true,
title : 'Agregar un contacto!',
          plain: true,
        modal: true ,
		width: 195,
		autoShow:true,
		bodyStyle : 'margin:5px 5px 5px 5px;padding:5px 5px 5px 5px', 
  items : [{		   
      xtype : 'form',
	  bodyStyle : 'margin:5px 5px 5px 5px;padding:5px 5px 5px 5px', 
      items : [        {
          xtype : 'textfield',
          fieldLabel : 'Nombre',
          name : 'nombre_add',
		  id  : 'nombre_add',
		  hideLabel: true,
                    blankText: 'El nombre es obligatorio!',
                    emptyText: 'El nombre',
                    allowBlank: false,
                    invalidText: 'El nombre es obligatorio!'
      },        {
          xtype : 'numberfield',
          name : 'cel_add',
		  id  : 'cel_add',
                    blankText: 'El Celular es obligatorio!',
                    emptyText: 'El Celular',
                    allowBlank: false,
                    minLength: 8,
                    maxLength: 8,
                    invalidText: 'El Celular es obligatorio!',
                    minLengthText: 'El numero es invalido',
					maxLengthText: 'El numero es invalido - 8 digitos',
          fieldLabel : 'cel',
		  hideLabel: true
      }]
  }],
    buttons: [{
                        text: 'Add',
                        handler: function() {
                          
						  
	if( Ext.getCmp('nombre_add').isValid()==true ){
			
				if( Ext.getCmp('cel_add').isValid()==true ){
					
						 Ext.Ajax.request({
                                url: 'core/store/service.php?xaction=2',
                                method: 'POST',
								params: {A: 1,name:Ext.getCmp('nombre_add').getValue(),numero:Ext.getCmp('cel_add').getValue()},
                                success: function(response, options) {
                                    jsonData = Ext.util.JSON.decode(response.responseText);									
                                    Ext.MessageBox.alert('Felicidades', ' El contacto a sido agregado!');
									add_c_win.hide();
									contacto_store.load();
                                },
                                failure: function(response, options) {
                                    jsonData = Ext.util.JSON.decode(response.responseText);
                                    Ext.MessageBox.alert('Error', jsonData.d.message);
                                }
                            });		
				}; 
						 
		}; 
						  
                        }
                    }, {
                        text: 'Cancel',
                        handler: function() {
                            add_c_win.close();
                        }
                    }]
  
});
        add_c_win.show(this);
		
        },
        iconCls: 'add_c'
    });

var del_contactos = new Ext.Action({
        text: 'Eliminar',
		bodyStyle : 'margin:5px 5px 5px 5px', 
        handler: function(){
			
		
	if (Ext.getCmp('grid_contactos').getSelectionModel().hasSelection())
{	
  		var s= Ext.getCmp('grid_contactos').getSelectionModel();
 		var r = s.getSelected();
		
		Ext.Ajax.request({
             url: 'core/store/service.php?xaction=3',
             method: 'POST',
             params: {A: 1,contacto:r.get('E')},
             success: function(response){

				var s = Ext.getCmp('grid_contactos').getSelectionModel().getSelections();
                for (var i = 0, r; r = s[i]; i++) {
                    contacto_store.remove(r);
                }
                             
                 },
             failure: function(response){
                      Ext.MessageBox.alert('Error', 'No se puede eliminar ese contacto');
              }
		});	
		
 	 };	
               
        },
        iconCls: 'del_c'
    });


				
				
		var form_mensajes = new Ext.FormPanel({			
            renderTo: 'agenda',
            frame: true,
            labelAlign: 'left',
            title: 'Agenda Telefonica',
            bodyStyle : 'padding:5px 5px 0 0',  
height: 210,
            layout: 'column',
			bbar: ['->',add_contactos,del_contactos],	
            items: [{
					xtype: 'grid',
					id: 'grid_contactos',
                    //layout: 'fit',
                    cm: ColumnModel_contacto,
                   // region: 'center',
                   // autoScroll: true,
                    store: contacto_store,
                   loadMask: true,
                    stripeRows: true,
                    //height: 260,
                    width: 555,
					//	autoHeight: false,	
					//	autoWidth : false,
					  height: 192,	
					 boxMaxHeight : 192,	
                    columnLines: true

            }]
        });
	
		
		";

	if ($debug == "true"){
		//print MODULE IN NORMAL MODE
		echo utf8_decode("<SCRIPT>Ext.onReady(function(){".$sms_send." });</SCRIPT>");
	}else
	if ($debug == "false"){		
		//print MODULE IN SECURE MODE
		$var = utf8_encode(" Ext.onReady(function(){ ".$sms_send." }); ");
  		$packer = new JavaScriptPacker($var,'Normal', 'true', 'true');
  		$packed = $packer->pack();
		echo ("<SCRIPT type=\"text/javascript\"> ".$packed." </SCRIPT>");
	}
}





?>