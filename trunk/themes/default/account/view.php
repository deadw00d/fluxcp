<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Viewing Account</h2>
<?php if ($account): ?>
<table class="vertical-table">
	<tr>
		<th>Username</th>
		<td><?php echo $account->userid ?></td>
		<th>Account ID</th>
		<td><?php echo $account->account_id ?></td>
	</tr>
	<tr>
		<th>E-mail</th>
		<td>
			<?php if ($account->email): ?>
				<?php echo htmlspecialchars($account->email) ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
		<th>Account Level</th>
		<td><?php echo (int)$account->level ?></td>
	</tr>
	<tr>
		<th>Gender</th>
		<td>
			<?php if ($gender = $this->genderText($account->sex)): ?>
				<?php echo $gender ?>
			<?php else: ?>
				<span class="not-applicable">Unknown</span>
			<?php endif ?>
		</td>
		<th>Account State</th>
		<td>
			<?php if (($state = $this->accountStateText($account->state)) && !$account->unban_time): ?>
				<?php echo $state ?>
			<?php elseif ($account->unban_time): ?>
				<span class="account-state state-banned">
					Banned Until
					<?php echo htmlspecialchars(date(Flux::config('DateTimeFormat'), $account->unban_time)) ?>
				</span>
			<?php else: ?>
				<span class="account-state state-unknown">Unknown</span>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Login Count</th>
		<td><?php echo number_format((int)$account->logincount) ?></td>
		<th>Credit Balance</th>
		<td>
			<?php echo number_format((int)$account->balance) ?>
			<?php if ($auth->allowedToDonate && $isMine): ?>
				<a href="<?php echo $this->url('donate') ?>">(Donate!)</a>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Last Login Date</th>
		<td colspan="3">
			<?php if (!$account->lastlogin || $account->lastlogin == '0000-00-00 00:00:00'): ?>
				<span class="not-applicable">Never</span>
			<?php else: ?>
				<?php echo $this->formatDateTime($account->lastlogin) ?>
			<?php endif ?>
		</td>
	</tr>
	<tr>
		<th>Last Used IP</th>
		<td colspan="3">
			<?php if ($account->last_ip): ?>
				<?php echo $account->last_ip ?>
			<?php else: ?>
				<span class="not-applicable">None</span>
			<?php endif ?>
		</td>
	</tr>
</table>
<?php foreach ($characters as $serverName => $chars): ?>
	<?php foreach ($chars as $char): ?>
		<h3>Characters on <?php echo htmlspecialchars($serverName) ?></h3>
		<?php if ($characters): ?>
		<table class="vertical-table">
			<tr>
				<th>Character Name</th>
				<th>Job Class</th>
				<th>Base Level</th>
				<th>Job Level</th>
				<th>Zeny</th>
			</tr>
			<?php foreach ($chars as $char): ?>
			<tr>
				<td><?php echo htmlspecialchars($char->name) ?></td>
				<td><?php echo htmlspecialchars($this->jobClassText($char->class)) ?></td>
				<td><?php echo (int)$char->base_level ?></td>
				<td><?php echo (int)$char->job_level ?></td>
				<td><?php echo number_format((int)$char->zeny) ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php else: ?>
		<p>This account has no characters on <?php echo htmlspecialchars($serverName) ?>.</p>
		<?php endif ?>
	<?php endforeach ?>
<?php endforeach ?>

<?php else: ?>
<p>
	Records indicate that the account you're trying to view does not exist.
	<a href="javascript:history.go(-1)">Go back</a>.
</p>
<?php endif ?>