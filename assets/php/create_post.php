<head>
<link rel="stylesheet" href="assets/css/create_post.css">
</head>

<!-- C du crud / CREER nouveau post -->


    <main id="main">
        
    <div class="img-preview__div" id="img-preview__div" >
        <img src="" alt="Image Preview" class="image-preview__img" />
        <span class="image-preview__default-text">Image Preview</span>
    </div>

    <form method="POST" action="assets/bdd/post_insert_action.php" enctype="multipart/form-data">
        
        
        <input type="file" name="file" class="inpFile" id="inpFile" />
            
            <textarea name="legende" id="legende" placeholder="Écrivez une légende"></textarea>     <br> <br>

            <input type="submit" value="Envoyer" class="envoyer">   <br> <br>

        </form>


</main>

<script src="assets/js/img-input-file.js"></script>
