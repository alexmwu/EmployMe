//for posting answers, comments, and editing
function post(post_type, page_id, form)
{
	content=form.content.value;
	if(post_type='edit_question'){
		type=0;
	}
	else if(post_type='answer'){
		type=1;
	}
	else if(post_type='edit_answer'){
		type=2;
	}
	else if(post_type='answer_comment'){
		type=3;
	}
	else if(post_type='question_comment'){
		type=4;
	}
	else{
		return;
	}
   $.ajax({
      url: '../post/post.php',
      type: 'post',
      data: 'post_type='+type+'&page_id='+page_id+'&content='+content,
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
	var questionContent = document.getElementById('question');
	var editQuestion = document.getElementById('editQuestion');
	if(post_type==0){
		editQuestion.innerHTML='<input type="textbox" name="content"><input type="button" value="Edit Question" onClick="post(0,'+page_id+',this.form)">';
	}	
}