<?php 
class ModelManga extends Model {
    public function getMangas() : array {
        $sql = "SELECT manga.id, manga.cover, manga.name, manga.rating,
                manga.nb_tomes, author.name AS author, GROUP_CONCAT(category.name) AS category,
                manga.published_at, manga.synopsis FROM manga
                INNER JOIN author ON manga.author_id=author.author_id
                INNER JOIN mangas_categories ON manga.id=mangas_categories.manga_id
                INNER JOIN category ON category.category_id=mangas_categories.category_id
                GROUP BY manga.id";
        $query = $this->getDb()->query($sql);

        $arrayMangas = [];
        while($manga = $query->fetch(PDO::FETCH_ASSOC)) {
            $arrayMangas[] = new Manga($manga);
        }

        return $arrayMangas;
    }

    public function getOneMangaById(int $id) : ?Manga {
        $sql = "SELECT manga.id, manga.cover, manga.name, manga.rating,
                manga.nb_tomes, author.name AS author, GROUP_CONCAT(category.name) AS category,
                manga.published_at, manga.synopsis FROM manga
                INNER JOIN author ON manga.author_id=author.author_id
                INNER JOIN mangas_categories ON manga.id=mangas_categories.manga_id
                INNER JOIN category ON category.category_id=mangas_categories.category_id
                WHERE manga.id=:id GROUP BY manga.id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        
        $manga = $query->fetch(PDO::FETCH_ASSOC);


        return $manga ? new Manga($manga) : NULL;
    }

    public function getOneMangaByName(str $name) : ?Manga {
        $sql = "SELECT manga.id, manga.cover, manga.name, manga.rating,
                manga.nb_tomes, author.name AS author, GROUP_CONCAT(category.name) AS category,
                manga.published_at, manga.synopsis FROM manga
                INNER JOIN author ON manga.author_id=author.author_id
                INNER JOIN mangas_categories ON manga.id=mangas_categories.manga_id
                INNER JOIN category ON category.category_id=mangas_categories.category_id
                WHERE name=:name";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_INT);
        $query->execute();
        
        $manga = $query->fetch(PDO::FETCH_ASSOC);

        return $manga ? new Manga($manga) : NULL;
    }

    public function addManga($name, $author, $synopsis, $rating, $cover, $nb_tomes, $publication, $category) {
        if(($author_id = $this->searchAuthor($author)) == 0) {
            $sql = "INSERT INTO author (name) VALUES (:name)";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':name', $author, PDO::PARAM_STR);
            $query->execute();
            $author_id = $this->searchAuthor($author);
        }

        if(($category_id = $this->searchCategory($category)) == 0) {
            $sql = "INSERT INTO category (name) VALUES (:name)";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':name', $category, PDO::PARAM_STR);
            $query->execute();
            $category_id = $this->searchCategory($category);
        }
        
        $sql = "INSERT INTO manga (name, author_id, synopsis, rating, cover, nb_tomes,
                published_at) VALUES (:name, :author_id, :synopsis, :rating,
                :cover, :nb_tomes, :published_at";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $query->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
        $query->bindParam(':rating', $rating, PDO::PARAM_INT);
        $query->bindParam(':cover', $cover, PDO::PARAM_STR);
        $query->bindParam(':nb_tomes', $nb_tomes, PDO::PARAM_INT);
        $query->bindParam(':published_at', $publication, PDO::PARAM_STR);
        
        if($query->execute()) {
            $manga_id = $this->getOneMangaByName($name)['id'];
            $sql = "INSERT INTO mangas_categories (manga_id, category_id) VALUES (:manga_id, :category_id)";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
            $query->bindParam(':category_id', $category_id, PDO::PARAM_INT); 
        
            return $query->execute();
        }
        return NULL;
    }

    public function searchAuthor(string $author) : int {
        $sql = "SELECT author_id FROM author WHERE name=:author";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->execute();

        if(($author_id = $query->fetch(PDO::FETCH_ASSOC)) == 0) {
            $author_id = 0;
        } else {
            $author_id = $author_id['author_id'];
        }

        return $author_id;
    }

    public function searchCategory(string $category) : int {
        $sql = "SELECT category_id FROM category WHERE name=:category";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->execute();

        if(!($category_id = $query->fetch(PDO::FETCH_ASSOC))) {
            $category_id = 0;
        }else {
            $category_id = $category_id['category_id'];
        }

        return $category_id;
    }

    public function updateOneMangaById(int $id, string $name, string $synopsis, int $rating, $published_at, $author, string $cover, $category, int $nb_tomes) : bool {
        if(($author_id = $this->searchAuthor($author)) == 0) {
            // var_dump($category_id);
            // exit;
            $sql = "INSERT INTO author (name) VALUES (:name)";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':name', $author, PDO::PARAM_STR);
            $query->execute();
            $author_id = $this->searchAuthor($author);
        }

        if(($category_id = $this->searchCategory($category)) == 0) {
            $sql = "INSERT INTO category (name) VALUES (:name)";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':name', $category, PDO::PARAM_STR);
            $query->execute();
            $category_id = $this->searchCategory($category);
        }

        $sql = "UPDATE manga
                SET name=:name, synopsis=:synopsis, rating=:rating, synopsis=:synopsis, rating=:rating,
                    published_at=:published_at, author_id=:author_id, cover=:cover, category_id=:category_id, nb_tomes=:nb_tomes 
                WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $query->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
        $query->bindParam(':rating', $rating, PDO::PARAM_INT);
        $query->bindParam(':cover', $cover, PDO::PARAM_STR);
        $query->bindParam(':nb_tomes', $nb_tomes, PDO::PARAM_INT);
        $query->bindParam(':published_at', $publication, PDO::PARAM_STR);
        $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        
        return $query->execute();
    }

    public function getOneCategoryById($id) {
        $sql = "SELECT category_id, name FROM category WHERE category_id=:category_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':category_id', $id, PDO::PARAM_INT);
        $query->execute();

        $category = $query->fetch(PDO::FETCH_ASSOC);

        return $category;
    }

    public function userLikeMangaById(int $user_id, int $manga_id) : void {
        $sql = "INSERT INTO likes (user_id, manga_id) VALUES (:user_id, :manga_id)";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();

        $sql = "UPDATE manga SET likes=(likes + 1) WHERE id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();
    }

    public function userUnlikeMangaById(int $user_id, int $manga_id) : void {
        $sql = "DELETE FROM likes WHERE user_id=:user_id AND manga_id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();

        $sql = "UPDATE manga SET likes=(likes - 1) WHERE id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();
    }

    public function mangaLikedByUser(int $user_id, int $manga_id) {
        $sql = "SELECT COUNT(user_id) FROM likes WHERE user_id=:user_id AND manga_id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['COUNT(user_id)'] == 0 ? false : true;
    }

    public function nbOfLikes(int $manga_id) {
        $sql = "SELECT likes FROM manga WHERE id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();

        $nbLikes = $query->fetch(PDO::FETCH_ASSOC);

        return $nbLikes['likes'];
    }

    public function getMangasByLikes() {
        $sql = "SELECT manga.id, manga.cover, manga.name, manga.rating,
                manga.nb_tomes, author.name AS author, GROUP_CONCAT(category.name) AS category,
                manga.published_at, manga.synopsis, likes FROM manga
                INNER JOIN author ON manga.author_id=author.author_id
                INNER JOIN mangas_categories ON manga.id=mangas_categories.manga_id
                INNER JOIN category ON category.category_id=mangas_categories.category_id
                GROUP BY manga.id ORDER BY likes DESC";
        $query = $this->getDb()->query($sql);

        $arrayMangas = [];
        while($manga = $query->fetch(PDO::FETCH_ASSOC)) {
            $arrayMangas[] = new Manga($manga);
        }

        return $arrayMangas;
    }

    public function rateOneMangaById(int $user_id, int $manga_id, int $rating) {
        if($this->searchOneRating($user_id, $manga_id) == false) {
            $sql = "INSERT INTO users_ratings (user_id, manga_id, rating) VALUES (:user_id, :manga_id, :rating)";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
            $query->bindParam(':rating', $rating, PDO::PARAM_INT);
            $query->execute();
        } else {
            $sql = "UPDATE users_ratings SET rating=:rating WHERE user_id=:user_id AND manga_id=:manga_id";
            $query = $this->getDb()->prepare($sql);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
            $query->bindParam(':rating', $rating, PDO::PARAM_INT);
            $query->execute();
        }
        
        
        $sql = "SELECT COUNT(rating), SUM(rating) FROM users_ratings WHERE manga_id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();
        $nbRatings = $query->fetch(PDO::FETCH_ASSOC);
        $newRating = $nbRatings['SUM(rating)'] / $nbRatings['COUNT(rating)'];

        $sql = "UPDATE manga SET rating=:newRating WHERE id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':newRating', $newRating, PDO::PARAM_INT);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();
    }

    public function searchOneRating(int $user_id, int $manga_id) {
        $sql = "SELECT COUNT(user_id) FROM users_ratings WHERE user_id=:user_id AND manga_id=:manga_id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $query->bindParam(':manga_id', $manga_id, PDO::PARAM_INT);
        $query->execute();
        $nbRatings = $query->fetch(PDO::FETCH_ASSOC);

        return $nbRatings['COUNT(user_id)'] == 0 ? false : true;
    }
}