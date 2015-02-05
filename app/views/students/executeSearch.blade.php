<!-- Importing Custom Search Script (Search Script - search.js) -->
<script src="<?php  echo asset('js/search.js'); ?>"></script>

<!-- Importing Custom Search Script (Search Script - search.js) -->
<script src="<?php  echo asset('js/myScripts.js'); ?>"></script>

<?php

$count = 1; // Value of count when @ Homepage without any pagination occurs
$page_var = parse_url(URL::full());

if(isset($page_var['query']))
{
	$page_var = explode("=", $page_var['query']);
	$count = ($page_var['1'] * $limit) - $limit + 1;
}
?>

<?php

	if(count($count_total_students) > 0)
		echo "<div class='label label-success'>" . count($count_total_students) . "&nbsp;Students Found!</div><br>";
	else
		echo "<div class='label label-danger'>" . "&nbsp;No Results Found!</div><br>";

?>

<table class="table table-hover animated bounceInDown">

<?php 

if(isset($students)) : foreach($students as $key => $value)
{
	
?>
	
	<h2>
		<tr><td valign="middle">
		<?php echo $count++; ?>
		.&nbsp;&nbsp;
		<?php echo $value->name ?>
		</td><td>
		<small>&nbsp;&nbsp;
		<a class="btn btn-info btn-xs" href='<?php echo URL::route('show', $value->id); ?>'>View</a>
		&nbsp;
		<a class="btn btn-warning btn-xs" href='<?php echo "students/$value->id/edit" ?>'>Edit</a>
		&nbsp;
		@if(Auth::user()->id == $value->id)
      {{ Form::open(array('method' => 'delete', 'route' => ['students.destroy', $value->id], 'class' => 'delete_form' )) }}
        <button type="submit" class="btn btn-danger btn-xs" disabled="disabled" data-toggle="tooltip" data-placement="right" title="Can't Delete Yourself!">Delete</button>
      {{ Form::close() }}
    @else
      {{ Form::open(array('method' => 'delete', 'route' => ['students.destroy', $value->id], 'class' => 'delete_form' )) }}
        <button type="submit" class="btn btn-danger btn-xs">Delete</button>
      {{ Form::close() }}
    @endif
		</small>
		</td>
		</tr>
	</h2>
		
<?php } ?>

</table>


<!-- PAGINATION -->
<center><div class="pagination_searchStudents"> {{ $students->links() }} </div></center>

<?php else : ?>

	<p class="bg-danger">No Records present in the DB..!!</p>

<?php endif; ?>