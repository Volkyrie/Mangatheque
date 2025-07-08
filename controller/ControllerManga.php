<?php
class ControllerManga {
    public function mangaList() {
        $modelManga = new ModelManga();
        $mangas = $modelManga->getMangas();
        require './view/page/mangaspage.php';
    }

    public function oneMangaById(int $id) {
        $modelManga = new ModelManga();
        $manga = $modelManga->getOneMangaById($id);
        if(!$manga) {
            http_response_code(404);
            require './view/manga/manganotfound.php';
            exit;
        }
        require './view/manga/mangapage.php';
    }

    public function mangaCreate(){
        require './view/manga/createmangapage.php';
    }

    public function mangaStore(){
        var_dump($_POST);
        exit;
        $modelManga = new ModelManga();
        if(isset($_POST['update'])) {
            $name = $modelManga->trim($_POST['name']);
            $name = $modelManga->trim($_POST['author']);
            $synopsis = $modelManga->trim($_POST['synopsis']);
            $rating = $modelManga->trim($_POST['rating']);
            $cover = $modelManga->trim($_POST['cover']);
            $nb_tomes = $modelManga->trim($_POST['nb_tomes']);
            $publication = $modelManga->trim($_POST['publication']);
            $category = $modelManga->trim($_POST['category']);

            $manga = $modelManga->addManga($name, $author, $synopsis, $rating,
                    $cover, $nb_tomes, $publication, $category);
        }
    }

    public function updateMangaById(int $id) {
        $modelManga = new ModelManga();
        if(isset($_POST['update'])) {
            $success = $modelManga->updateOneMangaById($id, trim($_POST['pseudo']), trim($_POST['email']), trim($_POST['password']));
            if(!$success) {
                http_response_code(404);
                $error = "Aucun manga n'a été mis à jour";
            } else {
                $message = "Manga mis à jour";
            }
            header('Location: /mangatheque/mangas');
            exit;
        } else {
            $manga = $modelManga->getOneMangaById($id);
            if($manga == NULL) {
                $error = "Aucun manga trouvé";
                header('Location: /mangatheque/');
                exit;
            }
            require './view/manga/editmangapage.php';
        }
    }
}