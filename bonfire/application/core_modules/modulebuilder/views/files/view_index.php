<?php

$view = '
<div class="view split-view">
	
	<!-- Role List -->
	<div class="view">
	
	<?php if (isset($records) && is_array($records) && count($records)) : ?>
		<div class="scrollable">
			<div class="list-view" id="role-list">
				<?php foreach ($records as $record) : ?>
					<?php $record = (array)$record;?>
					<div class="list-item" data-id="<?php echo $record[\''.$primary_key_field.'\']; ?>">
						<p>
							<b><?php echo $record[\''.$primary_key_field.'\']; ?></b><br/>
							<span class="small"><?php echo lang(\''.$module_name_lower.'_edit_text\'); ?></span>
						</p>
					</div>
				<?php endforeach; ?>
			</div>	<!-- /list-view -->
		</div>
	
	<?php else: ?>
	
	<div class="notification attention">
		<p><?php echo lang(\''.$module_name_lower.'_no_records\'); ?> <?php echo anchor(\'admin/'.$controller_name.'/'.$module_name_lower.'/create\', lang(\''.$module_name_lower.'_create_new\'), array("class" => "ajaxify")) ?></p>
	</div>
	
	<?php endif; ?>
	</div>
	<!-- Role Editor -->
	<div id="content" class="view">
		<div class="scrollable" id="ajax-content">
				
			<div class="box create rounded">
				<a class="button good ajaxify" href="/admin/'.$controller_name.'/'.$module_name_lower.'/create"><?php echo lang(\''.$module_name_lower.'_create_new_button\');?></a>

				<h3><?php echo lang(\''.$module_name_lower.'_create_new\');?></h3>

				<p><?php echo lang(\''.$module_name_lower.'_edit_text\'); ?></p>
			</div>
			<br />
				<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
					<h2>'.$module_name.'</h2>
	<table>
		<thead>';

for($counter=1; $field_total >= $counter; $counter++)
{
	// only build on fields that have data entered. 

	//Due to the requiredif rule if the first field is set the the others must be

	if (set_value("view_field_label$counter") == NULL)
	{
		continue; 	// move onto next iteration of the loop
	}
	$view .= '
		<th>'. set_value("view_field_label$counter").'</th>';
}

$view .= '<th><?php echo lang(\''.$module_name_lower.'_actions\'); ?></th>
		</thead>
		<tbody>
<?php
foreach ($records as $record) : ?>
<?php $record = (array)$record;?>
			<tr>
<?php
	foreach($record as $field => $value)
	{
		if($field != "'.$primary_key_field.'") {
?>
				<td><?php echo $value;?></td>

<?php
		}
	}
?>
				<td><?php echo anchor(\'admin/'.$controller_name.'/'.$module_name_lower.'/edit/\'. $record[\''.$primary_key_field.'\'], \'Edit\', \'class="ajaxify"\') ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
				<?php endif; ?>
				
		</div>	<!-- /ajax-content -->
	</div>	<!-- /content -->
</div>
';

	echo $view;
?>