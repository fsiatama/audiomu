<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeTipo_contacto = new Ext.data.JsonStore({
	url:'proceso/tipo_contacto/'
	,root:'datos'
	,sortInfo:{field:'tipo_contacto_id',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'tipo_contacto_id', type:'float'},
		{name:'tipo_contacto_nombre', type:'string'}
	]
});
var comboTipo_contacto = new Ext.form.ComboBox({
	hiddenName:'tipo_contacto'
	,id:modulo+'comboTipo_contacto'
	,fieldLabel:'<?php print _TIPO_CONTACTO; ?>'
	,store:storeTipo_contacto
	,valueField:'tipo_contacto_id'
	,displayField:'tipo_contacto_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmTipo_contacto = new Ext.grid.ColumnModel({
	columns:[
		{xtype:'numbercolumn', header:'<?php print _TIPO_CONTACTO_ID; ?>', align:'right', hidden:false, dataIndex:'tipo_contacto_id'},
		{header:'<?php print _TIPO_CONTACTO_NOMBRE; ?>', align:'left', hidden:false, dataIndex:'tipo_contacto_nombre'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbTipo_contacto = new Ext.Toolbar();

var gridTipo_contacto = new Ext.grid.GridPanel({
	store:storeTipo_contacto
	,id:modulo+'gridTipo_contacto'
	,colModel:cmTipo_contacto
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeTipo_contacto, displayInfo:true})
	,tbar:tbTipo_contacto
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formTipo_contacto = new Ext.FormPanel({
	baseCls:'x-panel-mc'
	,method:'POST'
	,baseParams:{accion:'act'}
	,autoWidth:true
	,autoScroll:true
	,trackResetOnLoad:true
	,monitorValid:true
	,bodyStyle:'padding:15px;'
	,reader: new Ext.data.JsonReader({
		root:'datos'
		,totalProperty:'total'
		,fields:[
			{name:'tipo_contacto_id', mapping:'tipo_contacto_id', type:'float'},
			{name:'tipo_contacto_nombre', mapping:'tipo_contacto_nombre', type:'string'}
		]
	})
	,items:[{
		xtype:'fieldset'
		,title:'Information'
		,layout:'column'
		,defaults:{
			columnWidth:0.33
			,layout:'form'
			,labelAlign:'top'
			,border:false
			,xtype:'panel'
			,bodyStyle:'padding:0 18px 0 0'
		}
		,items:[{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'tipo_contacto_id'
				,fieldLabel:'<?php print _TIPO_CONTACTO_ID; ?>'
				,id:modulo+'tipo_contacto_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'tipo_contacto_nombre'
				,fieldLabel:'<?php print _TIPO_CONTACTO_NOMBRE; ?>'
				,id:modulo+'tipo_contacto_nombre'
				,allowBlank:false
			}]
		}]
	}]
});
