<?php
session_start();
include_once('../../lib/config.php');
?>
/*<script>*/
var storeCountry = new Ext.data.JsonStore({
	url:'proceso/country/'
	,root:'datos'
	,sortInfo:{field:'Code',direction:'ASC'}
	,totalProperty:'total'
	,baseParams:{accion:'lista'}
	,fields:[
		{name:'Code', type:'string'},
		{name:'Name', type:'string'},
		{name:'Continent', type:'string'},
		{name:'Region', type:'string'},
		{name:'SurfaceArea', type:'string'},
		{name:'IndepYear', type:'float'},
		{name:'Population', type:'float'},
		{name:'LifeExpectancy', type:'string'},
		{name:'GNP', type:'string'},
		{name:'GNPOld', type:'string'},
		{name:'LocalName', type:'string'},
		{name:'GovernmentForm', type:'string'},
		{name:'HeadOfState', type:'string'},
		{name:'Capital', type:'float'},
		{name:'Code2', type:'string'}
	]
});
var comboCountry = new Ext.form.ComboBox({
	hiddenName:'country'
	,id:modulo+'comboCountry'
	,fieldLabel:'<?php print _COUNTRY; ?>'
	,store:storeCountry
	,valueField:'Code'
	,displayField:'country_nombre'
	,typeAhead:true
	,forceSelection:true
	,triggerAction:'all'
	,selectOnFocus:true
});
var cmCountry = new Ext.grid.ColumnModel({
	columns:[
		{header:'<?php print _CODE; ?>', align:'left', hidden:false, dataIndex:'Code'},
		{header:'<?php print _NAME; ?>', align:'left', hidden:false, dataIndex:'Name'},
		{header:'<?php print _CONTINENT; ?>', align:'left', hidden:false, dataIndex:'Continent'},
		{header:'<?php print _REGION; ?>', align:'left', hidden:false, dataIndex:'Region'},
		{header:'<?php print _SURFACEAREA; ?>', align:'left', hidden:false, dataIndex:'SurfaceArea'},
		{xtype:'numbercolumn', header:'<?php print _INDEPYEAR; ?>', align:'right', hidden:false, dataIndex:'IndepYear'},
		{xtype:'numbercolumn', header:'<?php print _POPULATION; ?>', align:'right', hidden:false, dataIndex:'Population'},
		{header:'<?php print _LIFEEXPECTANCY; ?>', align:'left', hidden:false, dataIndex:'LifeExpectancy'},
		{header:'<?php print _GNP; ?>', align:'left', hidden:false, dataIndex:'GNP'},
		{header:'<?php print _GNPOLD; ?>', align:'left', hidden:false, dataIndex:'GNPOld'},
		{header:'<?php print _LOCALNAME; ?>', align:'left', hidden:false, dataIndex:'LocalName'},
		{header:'<?php print _GOVERNMENTFORM; ?>', align:'left', hidden:false, dataIndex:'GovernmentForm'},
		{header:'<?php print _HEADOFSTATE; ?>', align:'left', hidden:false, dataIndex:'HeadOfState'},
		{xtype:'numbercolumn', header:'<?php print _CAPITAL; ?>', align:'right', hidden:false, dataIndex:'Capital'},
		{header:'<?php print _CODE2; ?>', align:'left', hidden:false, dataIndex:'Code2'}
	]
	,defaults:{
		sortable:true
		,width:100
	}
});
var tbCountry = new Ext.Toolbar();

var gridCountry = new Ext.grid.GridPanel({
	store:storeCountry
	,id:modulo+'gridCountry'
	,colModel:cmCountry
	,viewConfig: {
		forceFit: true
		,scrollOffset:2
	}
	,sm:new Ext.grid.RowSelectionModel({singleSelect:true})
	,bbar:new Ext.PagingToolbar({pageSize:10, store:storeCountry, displayInfo:true})
	,tbar:tbCountry
	,loadMask:true
	,border:false
	,title:''
	,iconCls:'icon-grid'
	,plugins:[new Ext.ux.grid.Excel()]
});
var formCountry = new Ext.FormPanel({
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
			{name:'Code', mapping:'Code', type:'string'},
			{name:'Name', mapping:'Name', type:'string'},
			{name:'Continent', mapping:'Continent', type:'string'},
			{name:'Region', mapping:'Region', type:'string'},
			{name:'SurfaceArea', mapping:'SurfaceArea', type:'string'},
			{name:'IndepYear', mapping:'IndepYear', type:'float'},
			{name:'Population', mapping:'Population', type:'float'},
			{name:'LifeExpectancy', mapping:'LifeExpectancy', type:'string'},
			{name:'GNP', mapping:'GNP', type:'string'},
			{name:'GNPOld', mapping:'GNPOld', type:'string'},
			{name:'LocalName', mapping:'LocalName', type:'string'},
			{name:'GovernmentForm', mapping:'GovernmentForm', type:'string'},
			{name:'HeadOfState', mapping:'HeadOfState', type:'string'},
			{name:'Capital', mapping:'Capital', type:'float'},
			{name:'Code2', mapping:'Code2', type:'string'}
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
				,xtype:''
				,name:'Code'
				,fieldLabel:'<?php print _CODE; ?>'
				,id:modulo+'Code'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:''
				,name:'Name'
				,fieldLabel:'<?php print _NAME; ?>'
				,id:modulo+'Name'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:''
				,name:'Continent'
				,fieldLabel:'<?php print _CONTINENT; ?>'
				,id:modulo+'Continent'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:''
				,name:'Region'
				,fieldLabel:'<?php print _REGION; ?>'
				,id:modulo+'Region'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:''
				,name:'SurfaceArea'
				,fieldLabel:'<?php print _SURFACEAREA; ?>'
				,id:modulo+'SurfaceArea'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'IndepYear'
				,fieldLabel:'<?php print _INDEPYEAR; ?>'
				,id:modulo+'IndepYear'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'Population'
				,fieldLabel:'<?php print _POPULATION; ?>'
				,id:modulo+'Population'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'LifeExpectancy'
				,fieldLabel:'<?php print _LIFEEXPECTANCY; ?>'
				,id:modulo+'LifeExpectancy'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'GNP'
				,fieldLabel:'<?php print _GNP; ?>'
				,id:modulo+'GNP'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'GNPOld'
				,fieldLabel:'<?php print _GNPOLD; ?>'
				,id:modulo+'GNPOld'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'LocalName'
				,fieldLabel:'<?php print _LOCALNAME; ?>'
				,id:modulo+'LocalName'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'GovernmentForm'
				,fieldLabel:'<?php print _GOVERNMENTFORM; ?>'
				,id:modulo+'GovernmentForm'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'HeadOfState'
				,fieldLabel:'<?php print _HEADOFSTATE; ?>'
				,id:modulo+'HeadOfState'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'Capital'
				,fieldLabel:'<?php print _CAPITAL; ?>'
				,id:modulo+'Capital'
				,allowBlank:false
			}]
		},{
			defaults:{anchor:'100%'}
			,items:[{
				,xtype:'numberfield'
				,name:'Code2'
				,fieldLabel:'<?php print _CODE2; ?>'
				,id:modulo+'Code2'
				,allowBlank:false
			}]
		}]
	}]
});
