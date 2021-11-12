import React, { Component } from 'react';
import ReactDom from 'react-dom';
import {Link} from "./Link";
import 'bootstrap/dist/css/bootstrap.min.css';

class App extends Component {
    render() {
        return (
            <Link />
        )
    }
}

ReactDom.render(<App />, document.getElementById('root'));