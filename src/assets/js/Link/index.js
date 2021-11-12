import React, { Component } from 'react';
import {LinkCreate} from "./LinkCreate";
import {LinkList} from "./LinkList";

export const Link = () => {
    return (
        <>
            <LinkCreate />
            <LinkList />
        </>
    );
}