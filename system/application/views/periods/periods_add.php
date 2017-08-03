<?php
if( !isset($period_id) ){
	$period_id = @field($this->uri->segment(3, NULL), $this->validation->period_id, 'X');
}
echo form_open('periods/save', array('class' => 'cssform', 'id' => 'schoolday_add'), array('period_id' => $period_id) );
$t = 1;
?>

<fieldset><legend accesskey="R" tabindex="<?php echo $t; $t++; ?>">Detalhes do Período</legend>
<p>
  <label for="name" class="required">Nome</label>
  <?php
	$name = @field($this->validation->name, $period->name);
	echo form_input(array(
		'name' => 'name',
		'id' => 'name',
		'size' => '25',
		'maxlength' => '30',
		'tabindex' => $t,
		'value' => $name,
	));
	$t++;
	?>
</p>
<?php echo @field($this->validation->name_error) ?>


<p>
  <label for="time_start" class="required">Horário de Início</label>
  <?php
	$time_start = strftime('%H:%M', strtotime(@field($this->validation->time_start, $period->time_start)));
	echo form_input(array(
		'name' => 'time_start',
		'id' => 'time_start',
		'size' => '5',
		'maxlength' => '5',
		'tabindex' => $t,
		'value' => $time_start,
	));
	$t++;
	?>
</p>
<?php echo @field($this->validation->time_start_error) ?>


<p>
  <label for="time_end" class="required">Horário de Fim</label>
  <?php
	$time_end = strftime('%H:%M', strtotime(@field($this->validation->time_end, $period->time_end)));
	#strftime('%H:%M', $time_start)
	echo form_input(array(
		'name' => 'time_end',
		'id' => 'time_end',
		'size' => '5',
		'maxlength' => '5',
		'tabindex' => $t,
		'value' => $time_end,
	));
	$t++;
	?>
</p>
<?php echo @field($this->validation->time_end_error) ?>


<p>
  <label for="days" class="required">Dias da Semana</label>
  <?php
	if( isset( $_POST['days'] ) ){
		foreach( $_POST['days'] as $k => $v ){
			$days_bitmask->set_bit( $v );
		}
		$days = $days_bitmask->forward_mask;
	}
  $days_bitmask->reverse_mask( @field( $days, $period->days ) );
  ?>
  <select name="days[]" id="days[]" multiple="multiple" size="7" tabindex="<?php echo $t; $t++; ?>">
  <?php
  foreach( $days_list as $day_num => $day_name ){
  	$is_sel = ($days_bitmask->bit_isset($day_num)) ? 'selected="selected"' : '';
		echo sprintf('<option value="%s" %s>%s</option>', $day_num, $is_sel, $day_name) . "\n";
  }
  
	#echo form_dropdown('days[]', $days, $selected, 'multiple="multiple" size="7"');
	/*foreach( $days as $day_num => $day_name ){
		#echo $ifid." = ".$ifname."<br>";
		echo form_checkbox( array(
					'name' => 'days[]',
					'id' => 'day'.$day_num,
					'value' => "$day_num",
					'checked' => $bitmask_days->bit_isset($day_num)
				) );
		echo '<label for="day'.$day_num.'" class="ni">'.$day_name.'</label><br/>';
	}*/
	?>
	</select>
</p>
<?php echo @field($this->validation->days_error) ?>



<p>
  <label for="bookable">Pode ser Agendado</label>
  <?php
	#$photo = @field($this->validation->name, $room->name);
	$bookable = @field($this->validation->bookable, $period->bookable);
	echo form_checkbox( array( 
		'name' => 'bookable',
		'id' => 'bookable',
		'value' => '1',
		'tabindex' => $t,
		'checked' => $bookable,
	));
	$t++;
	?>
	<p class="hint">Marque esta caixa para permitir agendamentos neste período</p>
</p>

</fieldset>


<?php
$submit['submit'] = array('Salvar', $t);
$submit['cancel'] = array('Cancelar', $t+1, 'periods');
$this->load->view('partials/submit', $submit);
echo form_close();
?>
