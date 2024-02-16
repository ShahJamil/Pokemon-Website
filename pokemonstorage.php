<?php
include_once("storage.php");

class PokemonStorage extends Storage {
  public function __construct() {
    parent::__construct(new JsonIO("pokemons.json"));
  }
}