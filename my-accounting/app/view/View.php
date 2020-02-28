<?php

namespace View;

class View {
    public function makeView($view, $data = null) {
        include __DIR__ . '/pages/' . $view . '-page.php';
    }
}