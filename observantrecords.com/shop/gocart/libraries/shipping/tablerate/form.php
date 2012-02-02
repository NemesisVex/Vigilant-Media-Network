<div style="font-size:11px;margin-bottom:20px;"><strong>Note:</strong> <em>Note Fields that are left blank or contain non-numeric will be removed.</em></div>
		<style type="text/css">
		.tablerate_input {
			width:50px;
		}
		
		#enabler {
			margin: 10px;
		}
		
		#add_name {
			margin: 10px;
		}
		
		/* Vertical Tabs
		----------------------------------*/
		.ui-tabs-vertical { width: 55em; margin-bottom:20px; }
		.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
		.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
		.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
		.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-selected { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
		.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em;}

		</style>
		
		<script type="text/javascript">
			$(function()
			{
				var $tabs = $("#tabs").tabs({  // immediately select a newly added tab
					    add: function(event, ui) {
					        $tabs.tabs('select', '#' + ui.panel.id);
					    }
					}).addClass('ui-tabs-vertical ui-helper-clearfix');
				$("#tabs li").removeClass('ui-corner-top').addClass('ui-corner-left');
	
			});
			
			
			function add_table() 
			{
				if($('#add_name_input').val().length==0) return;
				
				form_contents = "<div id='template-div'>\
								<strong><span id='TBLID_name'>TBLNAME</span> Rates</strong>\
								(<a href='javascript:void(0)' onclick=\"remove_table('tbl_TBLID')\">Remove this table</a>)\
								(<a href=\"javascript:void(0)\" onclick=\"rename_table('TBLID')\">Rename this table</a>) <table><tr>\
								<div id=\"rename_TBLID\" style=\"display:none\">\
								<input type=\"text\" id=\"input_TBLID\" value=\"TBLNAME\" class=\"gc_tf1\">\
								<input type=\"button\" value=\"Change\" onclick=\"apply_rename('TBLID', 'TBLID')\" />\
								<input type=\"button\" value=\"Cancel\" onclick=\"cancel_rename('TBLID')\" /></div>\
								<table><tr><td>By Country</td><td colspan=\"2\">\
									<select name=\"location[TBLID]\">\
									<option value=''> N/A </option>\
									<?php 
									foreach($countries as $cid=>$name)
									{	
										echo "<option value=\\\"$cid\\\">$name</option>";
									}
									?>\
									</select></td></tr>\
								<tr><td>Method: </td><td colspan='2'><select name='method[TBLID]'>\
								<option value='price'>Price</option><option value='weight'>Weight</option></select></td></tr>\
								<tr><td colspan='3'>Rates: </td></tr>\
								<tr id='TBLID_0'><td>From: <input class='gc_tf1 tablerate_input' type='text' name='from[TBLID][]' value=''/></td>\
								<td>Rate: <input class='gc_tf1 tablerate_input' type='text' name='rate[TBLID][]' value=''/></td>\
								<td style='font-size:11px;'><a href=\"javascript:tablerate_remove('TBLID_0');\">(remove)</a>\
								 <a href=\"javascript:tablerate_add_above('TBLID',0)\">(add above)</a> \
								 <a href=\"javascript:tablerate_add_below('TBLID',0)\">(add below)</a></td>\
								</table></div>";
				
				tbl_name = $('#add_name_input').val();
				tbl_id = tbl_name.replace(new RegExp(' ','g'), '_');
				
				
				form_contents = form_contents.replace(/TBLNAME/gi, tbl_name);
				
				form_contents = form_contents.replace(/TBLID/gi, tbl_id);
				
				$('#tabs').append('<div id="tbl_'+ tbl_id +'"> '+ form_contents +' </div>');
				
				$("#tabs").tabs("add",'#tbl_'+ tbl_id, '<span id=\'label_'+ tbl_id +'\'>'+tbl_name+'</span>');
				
				$('#add_name_input').val('');
			}
		
			function remove_table(table)
			{
				if($('#tabs').tabs('length') == 1) 
				{
					alert('You must leave at least one table');
					return;
				}
				
				// delete form content
				$('#'+table).remove();
				// remove tab
				$('#tabs').tabs('remove', $('#tabs').tabs('option', 'selected'));
			}
		
			var tablecounts = {};
			<?php foreach($rates as $name=>$ratelist ) {  
			 	//  build table count list
				
				echo 'tablecounts.'.$name .' = '. count($rates[$name]).";\n";
		
			} ?>
			
			
			function tablerate_remove(row)
			{
				$('#'+row).remove();
			}
			
			function tablerate_add_below(table, row)
			{

				eval('next = tablecounts.'+table+' + 1; tablecounts.'+table+' = tablecounts.'+table+' +1;');
				$('#'+table+'_'+row).after('<tr id="'+table+'_'+next+'"><td>From: <input class="gc_tf1 tablerate_input" type="text" name="from['+table+'][]" value=""/></td><td>Rate: <input class="gc_tf1 tablerate_input" type="text" name="rate['+table+'][]" value=""/></td><td style="font-size:11px;"><a href="javascript:tablerate_remove(\''+table+'_'+next+'\');">(remove)</a> <a href="javascript:tablerate_add_above(\''+table+'\','+next+')">(add above)</a> <a href="javascript:tablerate_add_below(\''+table+'\','+next+')">(add below)</a></td>');
			}
			function tablerate_add_above(table, row)
			{
				eval('next = tablecounts.'+table+' + 1; tablecounts.'+table+' = tablecounts.'+table+' +1;');
				$('#'+table+'_'+row).before('<tr id="'+table+'_'+next+'"><td>From: <input class="gc_tf1 tablerate_input" type="text" name="from['+table+'][]" value=""/></td><td>Rate: <input class="gc_tf1 tablerate_input" type="text" name="rate['+table+'][]" value="" /></td><td style="font-size:11px;"><a href="javascript:tablerate_remove(\''+table+'_'+next+'\');">(remove)</a> <a href="javascript:tablerate_add_above(\''+table+'\','+next+')">(add above)</a> <a href="javascript:tablerate_add_below(\''+table+'\','+next+')">(add below)</a></td>');
			}
			
			
			
			function rename_table(tbl_id)
			{
				$('#rename_'+ tbl_id).show();
			}
			
			function cancel_rename(tbl_id)
			{
				$('#rename_'+ tbl_id).hide();
			}
			
			function apply_rename(tbl_id, tbl_name)
			{
				
				new_name = $('#input_'+tbl_id).val();
				
				new_id = new_name.replace(new RegExp(' ','g'), '_');
				
				$('#rename_'+ tbl_id).hide();
				
				// just replace the name, the table ID only matters for the DOM
				$('#'+tbl_id+'_name').html(new_name);
				
				// update tablecounts list
				eval('tablecounts.'+new_id+' = tablecounts.'+tbl_id+';');
				
				// change the tab label
				$('#label_'+tbl_id).html(new_name);
				
				// disable tab
				$('#tabs').tabs( "option", "disabled", true );
				
				//rename the id targets and the form field names
				$('#tabs').html( $('#tabs').html().replace(new RegExp(tbl_id,'g'), new_id) );
				
				// re-enable tab
				$('#tabs').tabs( "option", "disabled", false );			
				
			}
			

		</script>
		
		<div id="enabler">
		Table Rate Module Status: 
		<select name="enabled">
			
			<?php 
			if($settings['enabled'] == 1)
			{
				$enable		= ' selected="selected"';
				$disable	= '';
			}
			else
			{
				$enable		= '';
				$disable	= ' selected="selected"';
			}
			?>
			<option value="1" <?php echo $enable ?>>Enabled</option>
			<option value="0" <?php echo $disable ?>>Disabled</option>
			</select>
		</div>
		
		<div id='add_name'> Add New Table <input type="text" id="add_name_input" class="gc_tf1" /> <input type="button" value="Add" onclick='add_table()' /></div>		
<div id="tabs">
		
		<ul id='name_list'>
		<?php foreach($rates as $name=>$ratelist ) {  ?>
			 <li> <a href="#tbl_<?php echo $name ?>" id='label_<?php echo $name ?>'><?php echo str_replace('_', ' ', $name); ?></a></li>
		<?php } ?>
		</ul>
		<?php foreach ($rates as $name=>$table) { 
				$disp_name = str_replace('_', ' ', $name);
		?>
		<div id='tbl_<?php echo $name ?>' >
			<strong><span id='<?php echo $name ?>_name'><?php echo $disp_name ?></span> Rates</strong> (<a href="javascript:void(0)" onclick="remove_table('tbl_<?php echo $name ?>')">Remove this table</a>) (<a href="javascript:void(0)" onclick="rename_table('<?php echo $name ?>')">Rename this table</a>) 
			<table><tr>
			
			<div id="rename_<?php echo $name ?>" style="display:none">
			
			<input type="text" id="input_<?php echo $name ?>" value="<?php echo $disp_name ?>" class="gc_tf1"> <input type="button" value="Change" onclick="apply_rename('<?php echo $name ?>', '<?php echo $name ?>')" /> <input type="button" value="Cancel" onclick="cancel_rename('<?php echo $name ?>')" /></div>
			
			<td>By Country</td>
			<td colspan="2">
				<select name="location[<?php echo $name ?>]">
				<option value=''> N/A </option>
				<?php 
				foreach($countries as $cid=>$c_name)
				{	
					echo '<option value="'.$cid.'"';
					//set which option is selected
					if(isset($settings['location'][$name]) && $settings['location'][$name]==$cid)
					{
						echo ' selected="selected"';
					}
					echo '>'.$c_name.'</option>';
				}
				?>
				</select>
			</td>
			</tr>
			
			<td>Method: </td><td colspan="2">
			<select name="method[<?php echo $name ?>]">
			<?php 
			//set which option is selected
			if($settings['method'][$name] == 'weight')
			{
				$weight	= ' selected="selected"';
			}
			else
			{
				$price	= ' selected="selected"';
			}
			?>
			<option value="price" <?php echo $price ?>>Price</option>
			<option value="weight" <?php echo $weight ?>>Weight</option>
			</select></td></tr>
			<tr><td colspan="3">Rates: </td></tr>
			<?php 
			$count	= 0;
			
			foreach ($table as $from => $rate)
			{
			?>	
				<tr id="<?php echo $name ?>_<?php echo $count ?>">
				<td>From: <input class="gc_tf1 <?php echo $name ?>_from tablerate_input" type="text" name="from[<?php echo $name ?>][]" value="<?php echo $from ?>"/></td>
				<td>Rate: <input class="gc_tf1 <?php echo $name ?>_rate tablerate_input" type="text" name="rate[<?php echo $name?>][]" value="<?php echo $rate ?>" /></td>
				<td style="font-size:11px;"><a href="javascript:tablerate_remove('<?php echo $name ?>_<?php echo $count ?>');">(remove)</a> <a href="javascript:tablerate_add_above('<?php echo $name ?>',<?php echo $count ?>)">(add above)</a> <a href="javascript:tablerate_add_below('<?php echo $name ?>',<?php echo $count ?>)">(add below)</a>
				</td>
				</tr>
			<?php 
				$count++;
			}
			?>
			</table>
		</div>
	<?php } ?>

</div>



		