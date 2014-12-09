//for posting answers, comments, and editing
function post(post_type, page_id, form)
{
	if(post_type==0){
		content=form.editQuestionContent.value;	
		post_type='editq';
	}
	else if(post_type==1){
		content=form.editAnswer.value;
		post_type='addans';
	}
	//post_type=0, editQuestion
	//1, addAnswer
   $.ajax({
      url: '../post/post.php',
      type: 'post',
      data: 'post_type='+post_type+'&page_id='+page_id+'&content='+content,
      success: function(output) 
      {
          alert('success, server says '+output);
      }, error: function()
      {
          alert('something went wrong, post failed');
      }
   });

   history.go(0);

}

function userEditPost(post_type,page_id){
	var question = document.getElementById('questionContent');
	var editQuestion = document.getElementById('editQuestion');
	var questionContent = question.innerHTML;
	if(post_type==0){
		editQuestion.innerHTML='<input type="textbox" name="editQuestionContent" placeholder="'+questionContent+'"><input type="button" value="Edit Question" onClick="post(0,'+page_id+',this.form)">';
		var content = document.getElementsByName('editQuestionContent')[0];
		content.value = questionContent;
	}


}