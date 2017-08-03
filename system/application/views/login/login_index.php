<?php echo $this->session->flashdata('auth') ?>

<?php
$t = 1;
echo form_open('login/submit', array('id'=>'login','class'=>'cssform'), array('page' => $this->uri->uri_string()) );
?>


<fieldset style="width:336px;"><legend accesskey="L" tabindex="<?php echo $t; ?>">Login</legend>
	<p>
	  <label for="username" class="required">Usuário</label>
	  <?php
		$username = @field($this->validation->username);
		echo form_input(array(
			'name' => 'username',
			'id' => 'username',
			'size' => '20',
			'maxlength' => '20',
			'tabindex' => $t,
			'value' => $username,
		));
		$t++;
		?>
	</p>
	<?php echo @field($this->validation->username_error); ?>


	<p>
	  <label for="password" class="required">Senha</label>
	  <?php
		$password = @field($this->validation->password);
		echo form_password(array(
			'name' => 'password',
			'id' => 'password',
			'size' => '20',
			'tabindex' => $t,
			'maxlength' => '20',
		));
		$t++;
		?>
	</p>
	<?php echo @field($this->validation->password_error); ?>
</fieldset>



<?php
$submit['submit'] = array('Entrar', $t);
$submit['cancel'] = array('Cancelar', $t+1, '');
$this->load->view('partials/submit', $submit);
echo form_close();
?>
