import React from 'react';

export default class extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <nav className="navbar navbar-dark bg-dark">
        <a className="navbar-brand" href="/">
          <img src="/static/img/logo.png"/>
          <span>UAGPMC</span>
        </a>
        <a className="nav-link" href="/about">About</a>
        <a className="nav-link joinLink disabled" href="javascript:void()">Media</a>
        <a className="nav-link joinLink disabled" href="javascript:void()">Join</a>
        <div id="navbarRight">
          <a className="nav-link" href="javascript:void()">Login</a>
        </div>
      </nav>
    )
  }
}
