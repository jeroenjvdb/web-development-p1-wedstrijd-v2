$(document).ready(function(){
function readUrl(input)
{
	$('#uploadImg').removeClass('invisible').attr('src', URL.createObjectURL(input.files[0]));
	// console.log(input.files);
	// console.log(input.files[0]);
	// if (input.files && input.files[0]);
	// {
	// 	// console.log('in if');
	// 	var reader = new FileReader();

	// 	reader.onload = function(e)
	// 	{
	// 		console.log('test');
	// 		$('#uploadImg').toggleClass('invisible');
	// 	};
	// }
};

$('#duvel').change(function(){
	console.log('onchange');
	readUrl(this);
});

});