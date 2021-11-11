import React, {useEffect, useState} from 'react';
import axios from 'axios';
import {Card, CardBody, CardHeader} from "reactstrap";
import {LinkDetail} from "./LinkDetail";

export const LinkList = () => {
    const [links, setLinks] = useState([]);

    useEffect(() => {
        axios.get(`http://localhost:8080/api/links`).then(res => {
            setLinks(res.data);
        })
    }, []);

    return (
        <Card>
            <CardHeader>
                <h3 className="h3">List of shortened urls</h3>
            </CardHeader>
            <CardBody>
                <ul className="list-group">
                    {links.map((link, index) => (
                        <LinkDetail link={link} key={index}/>
                    ))}
                </ul>
            </CardBody>
        </Card>
    )
}
