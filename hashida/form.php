<form action="./update.php" method="post" class="py-3">
	<div>
		<label>日付:</label>
		<input type="date" name="date">
	</div>
	<div>
		<label>名前:</label>
		<input type="text" name="name">
	</div>
	<div>
		<label>コース:</label>
		<select type="text" name="place">
			<option>青葉台</option>
			<option>河原</option>
			<option>城址</option>
			<option>その他</option>
		</select>

	</div>
	<div>
		<label>タイム:</label>
		<input type="number" name="min" class="min">分
		<input type="number" name="sec" class="sec">秒
	</div>
	<input type="submit" id="add_button" value="記録を追加">
</form>



