<?php

namespace App\DataFixtures\Service;


class LoremIpsumGenerator
{
    public function generateLorem($len = null, $rand = null) {
        $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vivamus at augue eget arcu dictum varius duis at consectetur. Gravida arcu ac tortor dignissim convallis aenean et. Laoreet sit amet cursus sit. Orci phasellus egestas tellus rutrum. Sit amet nulla facilisi morbi tempus. Nisi vitae suscipit tellus mauris a diam maecenas. Non enim praesent elementum facilisis leo vel fringilla. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Quis viverra nibh cras pulvinar mattis nunc sed. Sem viverra aliquet eget sit amet tellus cras adipiscing enim. Etiam tempor orci eu lobortis elementum. Nibh mauris cursus mattis molestie a iaculis. Viverra orci sagittis eu volutpat odio. Bibendum ut tristique et egestas. Integer feugiat scelerisque varius morbi enim nunc. Ipsum faucibus vitae aliquet nec ullamcorper. Turpis tincidunt id aliquet risus. A arcu cursus vitae congue mauris rhoncus aenean vel. Sit amet nulla facilisi morbi tempus iaculis urna.
        Porttitor lacus luctus accumsan tortor. In hac habitasse platea dictumst vestibulum rhoncus est pellentesque. In ante metus dictum at. Sapien et ligula ullamcorper malesuada proin libero nunc consequat. Tincidunt lobortis feugiat vivamus at. Suscipit tellus mauris a diam maecenas sed. Quis varius quam quisque id diam vel. Aliquam sem fringilla ut morbi tincidunt augue interdum. Bibendum neque egestas congue quisque egestas diam in arcu cursus. Cursus in hac habitasse platea. Est ante in nibh mauris. Metus aliquam eleifend mi in nulla posuere sollicitudin aliquam ultrices. Adipiscing commodo elit at imperdiet dui accumsan sit. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris pellentesque. At tellus at urna condimentum mattis pellentesque id nibh tortor. Sodales neque sodales ut etiam sit amet nisl.";
        $lorem_array = explode(' ', $lorem);
        if(!$len) {
            $len = random_int(10, 100);
        }
        if(!$rand) {
            $rand = random_int(0, 100);
        }
        $arr = [];
        for($i = 0; $i < $len; $i++) {
            $arr[] = $lorem_array[($rand * $i) % count($lorem_array)];
        }
        return implode(' ', $arr); 
    }
}
