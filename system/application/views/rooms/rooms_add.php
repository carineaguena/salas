<?php
if( !isset($room_id) ){
	$room_id = @field($this->uri->segment(3, NULL), $this->validation->room_id, 'X');
}
$errorstr = $this->validation->error_string;

#echo $room_id;

echo form_open_multipart('rooms/save', array('class' => 'cssform', 'id' => 'rooms_add'), array('room_id' => $room_id) );

$t = 1;
?>

<p>

</p>

<fieldset><legend accesskey="R" tabindex="<?php echo $t; $t++; ?>">Detalhes da Sala</legend>


<p>
  <label for="name" class="required">Nome</label>
  <?php
	$name = @field($this->validation->name, $room->name);
	echo form_input(array(
		'name' => 'name',
		'id' => 'name',
		'size' => '20',
		'maxlength' => '20',
		'tabindex' => $t,
		'value' => $name,
	));
	$t++;
	?>
</p>
<?php echo @field($this->validation->name_error) ?>


<p>
  <label for="location">Localização</label>
  <?php
	$location = @field($this->validation->location, $room->location);
	echo form_input(array(
		'name' => 'location',
		'id' => 'location',
		'size' => '30',
		'maxlength' => '40',
		'tabindex' => $t,
		'value' => $location,
	));
	$t++;
	?>
</p>
<?php echo @field($this->validation->location_error) ?>


<p>
  <label for="user_id">Professor</label>
  <?php
	$userlist['0'] = '(None)';
  foreach($users as $user){
  	if( $user->displayname == '' ){ $user->displayname = $user->username; }
  	$userlist[$user->user_id] = $user->displayname;		#@field($user->displayname, $user->username);
  }
	$user_id = @field($this->validation->user_id, $room->user_id, '0');
	echo form_dropdown('user_id', $userlist, $user_id, 'tabindex="'.$t.'"');
	$t++;
	?>
</p>
<?php echo @field($this->validation->user_id_error) ?>


<p>
  <label for="notes">Notas</label>
  <?php
	$notes = @field($this->validation->notes, $room->notes);
	echo form_textarea(array(
		'name' => 'notes',
		'id' => 'notes',
		'rows' => '5',
		'cols' => '30',
		'tabindex' => $t,
		'value' => $notes,
	));
	$t++;
	?>
</p>
<?php echo @field($this->validation->user_id_error) ?>


<p>
  <label for="bookable">Pode ser Agendado</label>
  <?php
	#$photo = @field($this->validation->name, $room->name);
	$bookable = @field($this->validation->bookable, $room->bookable);
	echo form_checkbox( array( 
		'name' => 'bookable',
		'id' => 'bookable',
		'value' => '1',
		'tabindex' => $t,
		'checked' => $bookable,
	));
	$t++;
	?>
	<p class="hint">Marque esta caixa para permitir reservas para esta sala (Por exemplo, desmarque se a sala está fora de ação)</p>
</p>


<p>
  <label for="icon">Icon</label>
  <div class="iconbox" style="width:300px;height:180px">
  <?php
	$icon = @field($this->validation->icon, $room->icon);
	#echo iconsel("icon", "rooms/icons", $icon, 'tabindex="6"');
	echo iconbox("icon", "standardicons", $icon, 'tabindex="'.$t.'"');
	$t++;
	?>
	</div>
</p>
<?php echo @field($this->validation->icons_error) ?>
</fieldset>




<fieldset><legend accesskey="P" tabindex="7">Foto</legend>
Use esta seção para carregar uma fotografia opcional da sala para permitir uma identificação mais fácil.<br /><br />
A foto principal será redimensionada para 640x480, e pequenas miniaturas serão criadas.

<p>
  <label>Foto atual</label>
  <?php
	if( isset($room->photo) && $room->photo != ''){
		$photo['640'] = 'webroot/images/roomphotos/640/'.$room->photo;
		$photo['160'] = 'webroot/images/roomphotos/160/'.$room->photo;
		if( file_exists($photo['160']) && file_exists($photo['640']) ){
			echo '<a href="'.$photo['640'].'" title="View Photo">';
			echo '<img src="'.$photo['160'].'" width="160" height="120" style="padding:1px;border:1px solid #ccc" alt="View Photo" />';
			echo '</a>';
		} else {
			echo '<em>None on file</em>';
		}
	} else {
		echo '<em>None in database</em>';
	}
	/*$photo_file = 'webroot/images/roomphotos/'.$room_id.'.jpg';
	if( file_exists( $photo_file ) ) {
		#echo '<a href="'.$photo_file.'" title="View Photo"><img src="webroot/images/ui/picture.png" width="16" height="16" alt="View Photo" /></a>';
		echo '<img src="'.$photo_file.'" width="160" height="120" style="padding:1px;border:1px solid #ccc" />';		
	} else {
		echo '<em>None</em>';
	}*/
	?>
</p>

<p>
  <label for="userfile">Upload de Arquivo</label>
  <?php
	#$photo = @field($this->validation->photo, $room->photo);
	echo form_upload(array(
		'name' => 'userfile',
		'id' => 'userfile',
		'size' => '30',
		'maxlength' => '255',
		'tabindex' => $t,
		'value' => '',
	));
	$t++;
	?>
	<p class="hint">Fazendo o upload de uma nova foto irá <span>sobreescrever</span> a atual.</p>
</p>
<?php if($this->session->flashdata('image_error') != '' ){ ?>
<p class="hint error"><span><?php echo $this->session->flashdata('image_error') ?></span></p>
<?php } ?>

<p>
  <label for="photo_delete">Apaga a foto?</label>
  <?php
	#$photo = @field($this->validation->name, $room->name);
	echo form_checkbox( array( 
		'name' => 'photo_delete',
		'id' => 'photo_delete',
		'value' => 'true',
		'tabindex' => $t,
		'checked' => false,
	));
	$t++;
	?>
	<p class="hint">Marque esta caixa para <span>deletar a foto atual</span>. Se você estiver adicionando uma nova foto isso irá acontecer automaticamente.</p>
</p>

 
</fieldset>



<?php if ($fields): ?>

<fieldset>
	
	<legend accesskey="F" tabindex="<?php echo $t; $t++; ?>">Fields</legend>

	<?php
	$tabindex = 12;
	
	foreach($fields as $field){

	echo '<p>';
	echo '<label>'.$field->name.'</label>';

		switch($field->type){
		
			case 'TEXT':
			
				$value = @field($fieldvalues[$field->field_id], NULL);
				echo form_input(array(
					'name' => 'f'.$field->field_id,
					'id' => 'f'.$field->field_id,
					'size' => '30',
					'maxlength' => '255',
					'tabindex' => $t,
					'value' => $value,	#$location,
				));
				break;
			
			
			case 'SELECT':
			
				$value = @field($fieldvalues[$field->field_id], NULL);
				$options = $field->options;
				foreach($options as $option){
					$opts[$option->option_id] = $option->value; 
				}
				echo form_dropdown('f'.$field->field_id, $opts, $value, 'tabindex="'.$t.'"');
				unset($opts);
				break;
				
				
			case 'CHECKBOX':

				$value = ( @field($fieldvalues[$field->field_id], NULL) == '1') ? true : false;
				echo form_checkbox( array( 
					'name' => 'f'.$field->field_id,
					'id' => 'f'.$field->field_id,
					'value' => '1',
					'tabindex' => $t,
					'checked' => $value,
				));
				break;

				
			}
		echo '</p>';
		
		$t++;
				
	}  // endforeach
	?>
	
</fieldset>

<?php endif; ?>




<?php
$submit['submit'] = array('Salvar', $t);
$submit['cancel'] = array('Cancelar', $t+1, 'rooms');
$this->load->view('partials/submit', $submit);
echo form_close();
?>
