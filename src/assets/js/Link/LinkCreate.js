import React, {useState} from 'react';
import axios from 'axios';
import {Button, Card, CardBody, CardHeader, Col, Input, Row} from "reactstrap";

export const LinkCreate = () => {
    const [url, setUrl] = useState(null);
    const [error, setError] = useState(null);

    const handleSubmit = (e) => {
        e.preventDefault();
        let bodyFormData = new FormData();
        bodyFormData.append('url', url);
        axios.post(`http://localhost:8080/api/links/create`, bodyFormData).then(() => {
            window.location.reload();
        }).catch((err) => {
            setError(err.response.data);
        })
    }

    return (
        <Card>
            <CardHeader>
                <h3 className="h3">Shorten URL</h3>
            </CardHeader>
            <CardBody>
                <form onSubmit={handleSubmit}>
                    <Row>
                        <Col>
                            <Row>
                                <Col sm={8}>
                                    <Input
                                        type="text"
                                        name="url"
                                        value={url ?? ""}
                                        onChange={e => setUrl(e.target.value)}
                                        placeholder="Paste a link to shorten it"
                                        className="normal-text url-input"
                                    />
                                </Col>
                                <Col sm={4}>
                                    <Button type="submit" disabled={!url}>Shorten</Button>
                                </Col>
                            </Row>
                        </Col>
                        <Col>

                        </Col>
                    </Row>
                    <Row>
                        <span className="text-danger">{error}</span>
                    </Row>
                </form>
            </CardBody>
        </Card>
    )
}
