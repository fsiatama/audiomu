<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeLic_samples = new Ext.data.JsonStore({
	url:'proceso/lic_samples/'
	,root:'datos'
	,sortInfo:{field:'lic_samples_id',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'lic_samples_id', type:'float'},
		{name:'lic_samples_nombre', type:'string'},
		{name:'lic_samples_ident', type:'string'},
		{name:'lic_samples_email', type:'string'},
		{name:'lic_samples_sample_id', type:'float'},
		{name:'lic_samples_desc', type:'string'},
		{name:'lic_samples_preg1', type:'string'},
		{name:'lic_samples_porq1', type:'string'},
		{name:'lic_samples_preg2', type:'string'},
		{name:'lic_samples_porq2', type:'string'},
		{name:'lic_samples_preg3', type:'string'},
		{name:'lic_samples_disponible1', type:'string'},
		{name:'lic_samples_disponible2', type:'string'},
		{name:'lic_samples_disponible3', type:'string'},
		{name:'lic_samples_disponible4', type:'string'},
		{name:'lic_samples_disponible5', type:'string'},
		{name:'lic_samples_disponible6', type:'string'},
		{name:'lic_samples_finsert', type:'date'Y-m-d H:i:s},
		{name:'lic_samples_key', type:'string'},
		{name:'lic_samples_descargada', type:'string'},
		{name:'lic_samples_fdescarga', type:'date'Y-m-d H:i:s}
	]
});
var comboLic_samples = new Ext.form.ComboBox({
	hiddenName:'lic_samples'
	,id:modulo+'comboLic_samples'
	,fieldLabel:'<?php print _LIC_SAMPLES; ?>'
	,store:storeLic_samples
	,valueField:'lic_samples_id'
	,displayField:'lic_samples_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmLic_samples = new Ext.grid.ColumnModel({
	columns:[
		{xtype:'numbercolumn', header:'<?php print _LIC_SAMPLES_ID; ?>', align:'right', hidden:false, dataIndex:'lic_samples_id'},
		{header:'<?php print _LIC_SAMPLES_NOMBRE; ?>', align:'left', hidden:false, dataIndex:'lic_samples_nombre'},
		{header:'<?php print _LIC_SAMPLES_IDENT; ?>', align:'left', hidden:false, dataIndex:'lic_samples_ident'},
		{header:'<?php print _LIC_SAMPLES_EMAIL; ?>', align:'left', hidden:false, dataIndex:'lic_samples_email'},
		{xtype:'numbercolumn', header:'<?php print _LIC_SAMPLES_SAMPLE_ID; ?>', align:'right', hidden:false, dataIndex:'lic_samples_sample_id'},
		{header:'<?php print _LIC_SAMPLES_DESC; ?>', align:'left', hidden:false, dataIndex:'lic_samples_desc'},
		{header:'<?php print _LIC_SAMPLES_PREG1; ?>', align:'left', hidden:false, dataIndex:'lic_samples_preg1'},
		{header:'<?php print _LIC_SAMPLES_PORQ1; ?>', align:'left', hidden:false, dataIndex:'lic_samples_porq1'},
		{header:'<?php print _LIC_SAMPLES_PREG2; ?>', align:'left', hidden:false, dataIndex:'lic_samples_preg2'},
		{header:'<?php print _LIC_SAMPLES_PORQ2; ?>', align:'left', hidden:false, dataIndex:'lic_samples_porq2'},
		{header:'<?php print _LIC_SAMPLES_PREG3; ?>', align:'left', hidden:false, dataIndex:'lic_samples_preg3'},
		{header:'<?php print _LIC_SAMPLES_DISPONIBLE1; ?>', align:'left', hidden:false, dataIndex:'lic_samples_disponible1'},
		{header:'<?php print _LIC_SAMPLES_DISPONIBLE2; ?>', align:'left', hidden:false, dataIndex:'lic_samples_disponible2'},
		{header:'<?php print _LIC_SAMPLES_DISPONIBLE3; ?>', align:'left', hidden:false, dataIndex:'lic_samples_disponible3'},
		{header:'<?php print _LIC_SAMPLES_DISPONIBLE4; ?>', align:'left', hidden:false, dataIndex:'lic_samples_disponible4'},
		{header:'<?php print _LIC_SAMPLES_DISPONIBLE5; ?>', align:'left', hidden:false, dataIndex:'lic_samples_disponible5'},
		{header:'<?php print _LIC_SAMPLES_DISPONIBLE6; ?>', align:'left', hidden:false, dataIndex:'lic_samples_disponible6'},
		{xtype:'datecolumn', header:'<?php print _LIC_SAMPLES_FINSERT; ?>', align:'left', hidden:false, dataIndex:'lic_samples_finsert', format:'Y-m-d, g:i a'},
		{header:'<?php print _LIC_SAMPLES_KEY; ?>', align:'left', hidden:false, dataIndex:'lic_samples_key'},
		{header:'<?php print _LIC_SAMPLES_DESCARGADA; ?>', align:'left', hidden:false, dataIndex:'lic_samples_descargada'},
		{xtype:'datecolumn', header:'<?php print _LIC_SAMPLES_FDESCARGA; ?>', align:'left', hidden:false, dataIndex:'lic_samples_fdescarga', format:'Y-m-d, g:i a'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbLic_samples = new Ext.Toolbar();

var gridLic_samples = new Ext.grid.GridPanel({
	store:storeLic_samples
	,id:modulo+'gridLic_samples'
	,colModel:cmLic_samples
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeLic_samples, displayInfo:true})
	,tbar:tbLic_samples
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formLic_samples = new Ext.FormPanel({
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
			{name:'lic_samples_id', mapping:'lic_samples_id', type:'float'},
			{name:'lic_samples_nombre', mapping:'lic_samples_nombre', type:'string'},
			{name:'lic_samples_ident', mapping:'lic_samples_ident', type:'string'},
			{name:'lic_samples_email', mapping:'lic_samples_email', type:'string'},
			{name:'lic_samples_sample_id', mapping:'lic_samples_sample_id', type:'float'},
			{name:'lic_samples_desc', mapping:'lic_samples_desc', type:'string'},
			{name:'lic_samples_preg1', mapping:'lic_samples_preg1', type:'string'},
			{name:'lic_samples_porq1', mapping:'lic_samples_porq1', type:'string'},
			{name:'lic_samples_preg2', mapping:'lic_samples_preg2', type:'string'},
			{name:'lic_samples_porq2', mapping:'lic_samples_porq2', type:'string'},
			{name:'lic_samples_preg3', mapping:'lic_samples_preg3', type:'string'},
			{name:'lic_samples_disponible1', mapping:'lic_samples_disponible1', type:'string'},
			{name:'lic_samples_disponible2', mapping:'lic_samples_disponible2', type:'string'},
			{name:'lic_samples_disponible3', mapping:'lic_samples_disponible3', type:'string'},
			{name:'lic_samples_disponible4', mapping:'lic_samples_disponible4', type:'string'},
			{name:'lic_samples_disponible5', mapping:'lic_samples_disponible5', type:'string'},
			{name:'lic_samples_disponible6', mapping:'lic_samples_disponible6', type:'string'},
			{name:'lic_samples_finsert', mapping:'lic_samples_finsert', type:'date'},
			{name:'lic_samples_key', mapping:'lic_samples_key', type:'string'},
			{name:'lic_samples_descargada', mapping:'lic_samples_descargada', type:'string'},
			{name:'lic_samples_fdescarga', mapping:'lic_samples_fdescarga', type:'date'}
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
				,name:'lic_samples_id'
				,fieldLabel:'<?php print _LIC_SAMPLES_ID; ?>'
				,id:modulo+'lic_samples_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_nombre'
				,fieldLabel:'<?php print _LIC_SAMPLES_NOMBRE; ?>'
				,id:modulo+'lic_samples_nombre'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_ident'
				,fieldLabel:'<?php print _LIC_SAMPLES_IDENT; ?>'
				,id:modulo+'lic_samples_ident'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_email'
				,fieldLabel:'<?php print _LIC_SAMPLES_EMAIL; ?>'
				,id:modulo+'lic_samples_email'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'lic_samples_sample_id'
				,fieldLabel:'<?php print _LIC_SAMPLES_SAMPLE_ID; ?>'
				,id:modulo+'lic_samples_sample_id'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_desc'
				,fieldLabel:'<?php print _LIC_SAMPLES_DESC; ?>'
				,id:modulo+'lic_samples_desc'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_preg1'
				,fieldLabel:'<?php print _LIC_SAMPLES_PREG1; ?>'
				,id:modulo+'lic_samples_preg1'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_porq1'
				,fieldLabel:'<?php print _LIC_SAMPLES_PORQ1; ?>'
				,id:modulo+'lic_samples_porq1'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_preg2'
				,fieldLabel:'<?php print _LIC_SAMPLES_PREG2; ?>'
				,id:modulo+'lic_samples_preg2'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_porq2'
				,fieldLabel:'<?php print _LIC_SAMPLES_PORQ2; ?>'
				,id:modulo+'lic_samples_porq2'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_preg3'
				,fieldLabel:'<?php print _LIC_SAMPLES_PREG3; ?>'
				,id:modulo+'lic_samples_preg3'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_disponible1'
				,fieldLabel:'<?php print _LIC_SAMPLES_DISPONIBLE1; ?>'
				,id:modulo+'lic_samples_disponible1'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_disponible2'
				,fieldLabel:'<?php print _LIC_SAMPLES_DISPONIBLE2; ?>'
				,id:modulo+'lic_samples_disponible2'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_disponible3'
				,fieldLabel:'<?php print _LIC_SAMPLES_DISPONIBLE3; ?>'
				,id:modulo+'lic_samples_disponible3'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_disponible4'
				,fieldLabel:'<?php print _LIC_SAMPLES_DISPONIBLE4; ?>'
				,id:modulo+'lic_samples_disponible4'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_disponible5'
				,fieldLabel:'<?php print _LIC_SAMPLES_DISPONIBLE5; ?>'
				,id:modulo+'lic_samples_disponible5'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'textfield'
				,name:'lic_samples_disponible6'
				,fieldLabel:'<?php print _LIC_SAMPLES_DISPONIBLE6; ?>'
				,id:modulo+'lic_samples_disponible6'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'datefield'
				,name:'lic_samples_finsert'
				,fieldLabel:'<?php print _LIC_SAMPLES_FINSERT; ?>'
				,id:modulo+'lic_samples_finsert'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'datefield'
				,name:'lic_samples_key'
				,fieldLabel:'<?php print _LIC_SAMPLES_KEY; ?>'
				,id:modulo+'lic_samples_key'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'datefield'
				,name:'lic_samples_descargada'
				,fieldLabel:'<?php print _LIC_SAMPLES_DESCARGADA; ?>'
				,id:modulo+'lic_samples_descargada'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'datefield'
				,name:'lic_samples_fdescarga'
				,fieldLabel:'<?php print _LIC_SAMPLES_FDESCARGA; ?>'
				,id:modulo+'lic_samples_fdescarga'
				,allowBlank:false
			}]
		}]
	}]
});
