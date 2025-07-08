<?php 
class ModelManga extends Model {
    public function getMangas() : array {
        $sql = "SELECT manga.id, manga.cover, manga.name, manga.rating,
                manga.nb_tomes, author.name AS author, category.name AS category,
                manga.published_at, manga.synopsis FROM manga
                INNER JOIN author ON manga.author_id=author.author_id
                INNER JOIN category ON manga.category_id=category.category_id";
        $query = $this->getDb()->query($sql);

        $arrayMangas = [];
        while($manga = $query->fetch(PDO::FETCH_ASSOC)) {
            $arrayMangas[] = new Manga($manga);
        }

        return $arrayMangas;
    }

    public function getOneMangaById(int $id) : ?Manga {
        $sql = "SELECT manga.id, manga.cover, manga.name, manga.rating,
                manga.nb_tomes, author.name AS author, category.name AS category,
                manga.published_at, manga.synopsis FROM manga
                INNER JOIN author ON manga.author_id=author.author_id
                INNER JOIN category ON manga.category_id=category.category_id
                WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        
        $manga = $query->fetch(PDO::FETCH_ASSOC);

        return $manga ? new Manga($manga) : NULL;
    }

    public function addManga($name, $author, $synopsis, $rating, $cover, $nb_tomes, $publication, $category) {
        
    }

    public function searchAuthor(string $author) : int {
        $sql = "SELECT author_id FROM author WHERE name=:author";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        if(!($author_id = $query->execute())) {
            $author_id = 0;
        }

        return $author_id;
    }

    public function searchCategory(string $category) : int {
        $sql = "SELECT category_id FROM category WHERE name=:category";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        if(!($category_id = $query->execute())) {
            $category_id = 0;
        }

        return $category_id;
    }

    public function updateOneMangaById(int $id, string $name, string $synopsis, int $rating, $published_at, $author, $category, int $nb_tomes) : bool {
        
        $sql = "UPDATE user 
                SET name=:name, synopsis=:synopsis, rating=:rating 
                WHERE id=:id";
        $query = $this->getDb()->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
        $query->bindParam(':rating', $rating, PDO::PARAM_STR);
        
        return $query->execute();
    }
}