<?php
class Manga {
    private int $id = 1;
    private string $name = 'Manga name';
    private string $cover = 'manga.jpg';
    private string $synopsis = 'This is a synopsis';
    private int $rating = 0;
    private int $nb_tomes = 0;
    private DateTimeImmutable $published_at;
    private string $author = 'toto';
    private string $category = 'fantasy';
    private int $likes = 0;

    public function __construct(array $datas) {
        $this->published_at = new \DateTimeImmutable();
        $this->hydrate($datas);
    }

    private function hydrate(array $datas) {
        foreach($datas as $key => $value) {
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getCover() : string {
        return $this->cover;
    }

    public function setCover(string $cover) : void {
        $this->cover = $cover;
    }

    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function getNb_tomes() : int {
        return $this->nb_tomes;
    }

    public function setNb_tomes(string $nb_tomes) : void {
        $this->nb_tomes = $nb_tomes;
    }

    public function getRating() : string {
        return $this->rating;
    }

    public function setRating(string $rating) : void {
        $this->rating = $rating;
    }

    public function getSynopsis() : string {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis) : void {
        $this->synopsis = $synopsis;
    }

    public function getAuthor() : string {
        return $this->author;
    }

    public function setAuthor(string $author) : void {
        $this->author = $author;
    }

    public function getCategory() : string {
        return $this->category;
    }

    public function setCategory(string $category) : void {
        $this->category = $category;
    }


    public function getPublished_at() : DateTimeImmutable {
        return $this->published_at;
    }

    public function setPublished_at(string $published_at) : void {
        $this->published_at = new \DateTimeImmutable($published_at);
    }

    public function getLikes() : string {
        return $this->likes;
    }

    public function setLikes(string $likes) : void {
        $this->likes = $likes;
    }
}