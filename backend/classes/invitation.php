<?php

    class Invitation {

        public $id;
        public $title;
        public $date;
        public $time;
        public $subject;
        public $place;

        function __construct($id, $title, $date, $time, $subject, $place) {
            $this->id = $id;
            $this->title = $title;
            $this->date = $date;
            $this->time = $time;
            $this->subject = $subject;
            $this->place = $place;
        }

    }


?>