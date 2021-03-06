<?php
echo $this->session->flashdata('saved');
echo form_open('weeks/saveacademicyear', array('class' => 'cssform', 'id' => 'saveacademicyear') );
?>


<fieldset style="width:50%"><legend accesskey="A" tabindex="1">Ano Acadêmico</legend>

<p>
  <label for="date_start" class="required">Data de início:</label>
  <?php
	$date_start = @field($this->validation->date_start, date("d/m/Y", strtotime($academicyear->date_start)));
	#echo $date_start;
	echo form_input(array(
		'name' => 'date_start',
		'id' => 'date_start',
		'size' => '10',
		'maxlength' => '10',
		'tabindex' => '2',
		'value' => $date_start,
	));
	?>
	<img style="cursor:pointer" align="top" src="webroot/images/ui/cal_day.gif" width="16" height="16" title="Choose date" onclick="displayDatePicker('date_start', false);" />
</p>
<?php echo @field($this->validation->date_start_error) ?>


<p>
  <label for="date_end" class="required">Data de Fim:</label>
  <?php
	$date_end = @field($this->validation->date_end, date("d/m/Y", strtotime($academicyear->date_end)));
	echo form_input(array(
		'name' => 'date_end',
		'id' => 'date_end',
		'size' => '10',
		'maxlength' => '10',
		'tabindex' => '2',
		'value' => $date_end,
	));
	?>
	<img style="cursor:pointer" align="top" src="webroot/images/ui/cal_day.gif" width="16" height="16" title="Choose date" onclick="displayDatePicker('date_end', false);" />
</p>
<?php echo @field($this->validation->date_end_error) ?>
</fieldset>


<?php
$submit['submit'] = array('Salvar', '5');
$submit['cancel'] = array('Cancelar', '6', 'weeks');
$this->load->view('partials/submit', $submit);
echo form_close();
?>
