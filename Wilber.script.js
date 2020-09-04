
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


      function article_sort(){
        let value_from_select = document.getElementById('article_sort').value;
        // alert(value_from_select);

        var elements = document.getElementsByClassName('thumbnail_article_container');
        console.log(elements);
        nb_elements = elements.length;
        for (var i = 0; i < nb_elements; i++){

            let current_article = elements[i];
            let value_of_category = elements[i].getElementsByClassName('thumbnail_article_category')[0].innerHTML;
            console.log(current_article);
            value_of_category = value_of_category.replace("...","");
            console.log(value_of_category);
            console.log(value_from_select);
            if(value_of_category == value_from_select){
                if (current_article.style.display == "none"){
                    current_article.style.display = "block";
                }
                console.log("oui");
            }else if(value_from_select == "Tous"){
                current_article.style.display = "block";

            }
            else{
                
                current_article.style.display = "none";

            }
        }
    }