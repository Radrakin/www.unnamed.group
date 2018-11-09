import React from 'react';

export default class extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
    this.discordClicked = this.discordClicked.bind(this);
  }

  discordClicked() {
    window.open('https://uagpmc.com/discord', '_blank');
  }

  render() {
    return (
      <button id="discordButton" type="button" className="btn btn-primary col" onClick={this.discordClicked}>
        <img src="/static/img/discord.svg"/>
      </button>
    )
  }
}
