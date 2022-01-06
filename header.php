<?php
function locationLoginPage($position, $active)
{
    if ($active === 0) {
        header('Location: ./Newpwd');
    } else {
        if ($position === 0) header('Location: ./Admin');
        if ($position === 1) header('Location: ./TLead');
        if ($position === 2) header('Location: ./Employee');
    }
}


function locationAdminPage($position, $active)
{
    if ($active === 0) {
        header('Location: ../Newpwd');
    } else {
        if ($position === 1) header('Location: ../TLead');
        if ($position === 2) header('Location: ../Employee');
    }
}

function locationTleadPage($position, $active)
{
    if ($active === 0) {
        header('Location: ../Newpwd');
    } else {
        if ($position === 0) header('Location: ../Admin');
        if ($position === 2) header('Location: ../Employee');
    }
}

function locationEmployeePage($position, $active)
{
    if ($active === 0) {
        header('Location: ../Newpwd');
    } else {
        if ($position === 0) header('Location: ../Admin');
        if ($position === 1) header('Location: ../TLead');
    }
}
