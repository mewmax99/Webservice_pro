<?php

require(APPPATH.'/libraries/REST_Controller.php');

class API extends REST_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Book_model');
        $this->load->model('Recipe_Model');
    }

    //API - client sends isbn and on valid isbn book information is sent back

    public function Recipe_get(){
        //$this->load->view('Recipe_View',$data);
        $result['recipe'] = $this->Recipe_Model->Recipe_Data();
        if($result){
            $this->response($result, 200);
        } 
        else{

            $this->response("No record found", 404);

        }
    }

    public function Comment_get(){
        $result['comment'] = $this->Recipe_Model->Get_All_Comment();
        if($result){
            $this->response($result, 200);
        } 
        else{

            $this->response("No record found", 404);

        }

    }

    public function CommentRes_get(){
        $result['comment'] = $this->Recipe_Model->Get_All_Res();
        if($result){
            $this->response($result, 200);
        } 
        else{

            $this->response("No record found", 404);

        }

    }

    public function CommentAtt_get(){
        $result['comment'] = $this->Recipe_Model->Get_All_Att();
        if($result){
            $this->response($result, 200);
        } 
        else{

            $this->response("No record found", 404);

        }

    }
    public function addCommentHotel_post(){
        $name = $this->input->post('name');
        $comment = $this->input->post('comment');
        if(!$name || !$comment){
            $this->response("Enter Comment or name to save", 400);
            //redirect('Barry/Coppy','refresh');
        }else{
            $data = array(
                'Com_name' => $this->input->post('name'),
                'Com_detail' => $this->input->post('comment')
            );
            $result = $this->Recipe_Model->Insert_Comment_Hotel($data);
            if($result === 0){
                $this->response("Book information coild not be saved. Try again.", 404);
            }else{
                //$this->response("success", 200);
                redirect('Barry/Coppy','refresh');
            }
        }    
    }

    public function addCommentAtt_post(){
        $name = $this->input->post('name');
        $comment = $this->input->post('comment');
        if(!$name || !$comment){
            $this->response("Enter Comment or name to save", 400);
            //redirect('Barry/Coppy','refresh');
        }else{
            $data = array(
                'Com_name' => $this->input->post('name'),
                'Com_detail' => $this->input->post('comment')
            );
            $result = $this->Recipe_Model->Insert_Comment_Att($data);
            if($result === 0){
                $this->response("Book information coild not be saved. Try again.", 404);
            }else{
                //$this->response("success", 200);
                redirect('Barry/Attractions_View','refresh');
            }
        }    

    }

    public function addCommentRes_post(){
        $name = $this->input->post('name');
        $comment = $this->input->post('comment');
        if(!$name || !$comment){
            $this->response("Enter Comment or name to save", 400);
            //redirect('Barry/Coppy','refresh');
        }else{
            $data = array(
                'Com_name' => $this->input->post('name'),
                'Com_detail' => $this->input->post('comment')
            );
            $result = $this->Recipe_Model->Insert_Comment_Res($data);
            if($result === 0){
                $this->response("Book information coild not be saved. Try again.", 404);
            }else{
                $this->response("success", 200);
                //redirect('Barry/Restaurant_View','refresh');
            }
        }    

    }



    function bookByIsbn_get(){

        $isbn  = $this->get('isbn');
        
        if(!$isbn){

            $this->response("No ISBN specified", 400);

            exit;
        }
        $this->load->model('Book_model');
        $result = $this->Book_model->getbookbyisbn( $isbn );

        if($result){

            $this->response($result, 200); 

            exit;
        } 
        else{

         $this->response("Invalid ISBN", 404);

         exit;
     }
 } 

    //API -  Fetch All books
 function books_get(){

    $result = $this->Book_model->getallbooks();

    if($result){

        $this->response($result, 200); 

    } 

    else{

        $this->response("No record found", 404);

    }
}

    //API - create a new book item in database.
function addBook_post(){
 $name      = $this->post('name');

 $price     = $this->post('price');

 $author    = $this->post('author');

 $category  = $this->post('category');

 $language  = $this->post('language');

 $isbn      = $this->post('isbn');

 $pub_date  = $this->post('publish_date');

 if(!$name || !$price || !$author || !$price || !$isbn || !$category){

    $this->response("Enter complete book information to save", 400);

}else{

    $result = $this->book_model->add(array("name"=>$name, "price"=>$price, "author"=>$author, "category"=>$category, "language"=>$language, "isbn"=>$isbn, "publish_date"=>$pub_date));

    if($result === 0){

        $this->response("Book information coild not be saved. Try again.", 404);

    }else{

        $this->response("success", 200);  

    }

}

}


    //API - update a book 
function updateBook_put(){

 $name      = $this->put('name');

 $price     = $this->put('price');

 $author    = $this->put('author');

 $category  = $this->put('category');

 $language  = $this->put('language');

 $isbn      = $this->put('isbn');

 $pub_date  = $this->put('publish_date');

 $id        = $this->put('id');

 if(!$name || !$price || !$author || !$price || !$isbn || !$category){

    $this->response("Enter complete book information to save", 400);

}else{
    $result = $this->book_model->update($id, array("name"=>$name, "price"=>$price, "author"=>$author, "category"=>$category, "language"=>$language, "isbn"=>$isbn, "publish_date"=>$pub_date));

    if($result === 0){

        $this->response("Book information coild not be saved. Try again.", 404);

    }else{

        $this->response("success", 200);  

    }

}

}

    //API - delete a book 
function deleteBook_delete()
{

    $id  = $this->delete('id');

    if(!$id){

        $this->response("Parameter missing", 404);

    }

    if($this->book_model->delete($id))
    {

        $this->response("Success", 200);

    } 
    else
    {

        $this->response("Failed", 400);

    }

}


}