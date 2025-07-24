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
        $modelManga = new ModelManga();
        if(isset($_POST['create'])) {
            $name = trim($_POST['name']);
            $author = trim($_POST['author']);
            $synopsis = trim($_POST['synopsis']);
            $rating = $_POST['rating'];
            $cover = trim($_POST['cover']);
            $nb_tomes = $_POST['nb_tomes'];
            $publication = $_POST['publication'];
            $category = trim($_POST['category']);

            $manga = $modelManga->addManga($name, $author, $synopsis, $rating,
                    $cover, $nb_tomes, $publication, $category);
        }

        header('Location: /mangatheque/mangas');
        exit;
    }

    public function updateMangaById(int $id) {
        $modelManga = new ModelManga();

        if(isset($_POST['update'])) {
            $name = trim($_POST['name']);
            $author = trim($_POST['author']);
            $synopsis = trim($_POST['synopsis']);
            $rating = $_POST['rating'];
            $cover = trim($_POST['cover']);
            $nb_tomes = $_POST['nb_tomes'];
            $publication = $_POST['publication'];
            $category = trim($_POST['category']);
            $success = $modelManga->updateOneMangaById($id, $name, $synopsis, $rating, $publication,
                        $author,  $cover, $category, $nb_tomes);
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

    public function sortMangaByCategory(int $id) {
        $modelManga = new ModelManga();
        $mangas = $modelManga->getMangas();
        $category = $modelManga->getOneCategoryById($id);
        require './view/manga/sortmangapage.php';
    }

    public function test(int $id) {
        $modelManga = new ModelManga();
        $manga = $modelManga->oneMangaById($id);
        $modelUser = new ModelUser();
        $user = $modelUser->getOneUserById($_SESSION['id']);

        require './view/manga/test.php';
    }

    public function like(int $id) {
        $modelManga = new ModelManga();
        $manga = $modelManga->oneMangaById($id);
        $modelManga->userLikeMangaById($_SESSION['id'], $manga->getId());

        header('Location: /mangatheque/mangas/'. $id .'/test');
        exit;
    }

    public function unlike(int $id) {
        $modelManga = new ModelManga();
        $manga = $modelManga->oneMangaById($id);
        $modelManga->userUnlikeMangaById($_SESSION['id'], $manga->getId());

        header('Location: /mangatheque/mangas/'. $id .'/test');
        exit;
    }
}