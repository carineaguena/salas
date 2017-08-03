<br />
<p style="text-align:center">
<label for="notes">Notas:</label> <input type="text" name="notes" id="notes" size="20" maxlength="100" value="<?php echo $this->session->userdata('notes') ?>" /> 
<label for="user_ud">Usuário:</label> <?php
	$userlist['0'] = '(None)';
  foreach($users as $user){
  	if( $user->displayname == '' ){ $user->displayname = $user->username; }
  	$userlist[$user->user_id] = $user->displayname;		#@field($user->displayname, $user->username);
  }
	$user_id = $this->session->userdata('user_id');
	echo form_dropdown('user_id', $userlist, $user_id, 'id="user_id"');
	?> 
  <input type="submit" value="Repita o Agendamento" />
</p>
</form>
