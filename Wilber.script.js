
    function erase_comment_form() {
      document.getElementById('comment_author').value = '';
      document.getElementById('comment_title').value = '';
      document.getElementById('comment_body').value = '';
    }

    
    function erase_article_form() {
        document.getElementById('article_author').value = '';
        document.getElementById('article_title').value = '';
        document.getElementById('article_body').value = '';
        tinymce.get("article_body").setContent("");
      }
