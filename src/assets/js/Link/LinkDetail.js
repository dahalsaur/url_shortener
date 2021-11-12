import React from 'react';
import {CopyToClipboard} from "react-copy-to-clipboard/lib/Component";
import {Button, Col, Row} from "reactstrap";

export const LinkDetail = (props) => {
    return (
        <li className="list-group-item">
            <Col>
                <Row>
                    <Col>
                        <a href={`http://localhost:8080/r/${props.link.slug}`} target="_blank">
                            <b>localhost:8080/r/<span style={{color: '#EB4A42'}}>{props.link.slug}</span></b>
                        </a>
                        {' '}
                        <CopyToClipboard text={`localhost:8080/r/${props.link.slug}`}>
                            <Button className="btn-sm btn-secondary">Copy</Button>
                        </CopyToClipboard>
                    </Col>
                    <Col>
                        Link visits: <b>{props.link.linkVisitCounts}</b>
                    </Col>
                    <Col>

                    </Col>
                </Row>
                <Row>
                    <a href={props.link.url}>{props.link.url}</a>
                </Row>
            </Col>
        </li>
    );
}