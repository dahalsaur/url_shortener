import React, { Component } from 'react';
import ReactDom from 'react-dom';

class App extends Component {
    render() {
        return (
            <div>
                <h2>Test</h2>
            </div>
        )
    }
}

ReactDom.render(<App />, document.getElementById('root'));