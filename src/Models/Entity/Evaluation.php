<?php

class Evaluation
{
    public int $id;
    public string $inscription_id;
    public string $matiere_id;
    public string $periode_id;
    public int $devoir1;
    public int $devoir2;
    public int $composition;




        public function __construct(
            int $id = 0,
            string $inscription_id = "",
            string $matiere_id = "",
            string $periode_id = "",
            string $devoir1 = "",
            string $devoir2 = "",
            string $composition = "",




            

            
        ) {
            $this->id = $id;
            $this->inscription_id = $inscription_id;
            $this->matiere_id = $matiere_id;
            $this->periode_id = $periode_id;
            $this->devoir1 = $devoir1;
            $this->devoir2 = $devoir2;
            $this->composition = $composition;



        }
}