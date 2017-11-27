<?php

function getAPI ($url) {
	return json_decode(file_get_contents($url), true);
}