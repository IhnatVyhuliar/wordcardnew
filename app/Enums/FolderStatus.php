<?php
namespace App\Enums;

enum FolderStatus:int
{
    case Private = 0;
    case Public = 1;
}