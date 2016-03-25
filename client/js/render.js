'use strict';

const Navbar = React.createClass({
  render() {
    return (
      <nav className="navbar navbar-inverse" role="navigation">
        <div className="container">
          <div className="navbar-header">
            <button type="button" className="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span className="icon-bar"></span>
              <span className="icon-bar"></span>
              <span className="icon-bar"></span>
            </button>
            <a className="navbar-brand" href="javascript:void(0)" onClick={this.props.setStartState.bind(null, null)}>Расписание занятий (preview)</a>
          </div>
          <div className="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul className="nav navbar-nav">
              <li>
                <a href="javascript:void(0)" onclick="">Контакты</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    )
  }
});

const Start = React.createClass({
  getInitialState() {
    return {
      descriptionShow:(cookies.getStartPageHideCheck() === undefined) ? true:false
    }
  },
  showDescription(bool) {
    this.setState({
      descriptionShow:bool
    });
    cookies.setStartPageHideCheck(bool);
  },
  render() {
    return (
      <div>
        {
          (this.state.descriptionShow) ? <Description showDescription={this.showDescription} />:null
        }
        <Tab setScheduleState={this.props.setScheduleState} />
      </div>
    )
  }
});

const Description = React.createClass({
  getInitialState() {
    return {
      description:["Здравствуй.",
      "На этом сайте ты можешь посмотреть расписание занятий Воронежского государственного технического университета, факультета ФИТКБ. Бесплатно, без регистрации и смс.",
      "Скрыть это сообщение"]
    }
  },
  render() {
    return (
      <header className="jumbotron">
        <h1>{this.state.description[0]}</h1>
        <p>{this.state.description[1]}</p>
        <a href="javascript:void(0)" className="btn btn-primary btn-large" onClick={this.props.showDescription.bind(null, false)}>{this.state.description[2]}</a>
      </header>
    )
  }
});

const Tab = React.createClass({
  componentWillMount() {
    //const groupsUrl = "../client/json/groups.json";
    const groupsUrl = "/?action=groups";
    let self = this;
    $.getJSON(groupsUrl, function (data) {
      self.setState({
        data:data
      })
    });
  },
  getInitialState() {
    return {
      data:[]
    }
  },
  scheduleRequest(course, group) {
    const data = `../client/json/schedules/${course}/${group}.json`;
    let self = this;
    $.getJSON(data, function (schedule) {
      self.props.setScheduleState(schedule);
    });
  },
  render() {
    let key = [0, 0, 0];
    let self = this;
    return (
      <div className="tab-menu">
        <ul className="nav nav-pills">
        {
          this.state.data.map(function (course) {
            return <li className={(key[0] === 0) ? "active":null} key={key[0]}><a data-toggle="tab" href={`#course-${key[0]++}`}>{course.name}</a></li>;
          })
        }
        </ul>
        <div className="tab-content">
        {
          this.state.data.map(function (course) {
            return (
              <div key={key[1]} id={`course-${key[1]++}`} className={(key[1] === 1) ? "tab-pane fade active in":"tab-pane fade"}>
                {
                  course.groups.map(function (group) {
                    return (
                      <a key={`1${key[2]++}`}
                        className="btn btn-default"
                        onClick={self.scheduleRequest.bind(self, course.name, group)}>{group.name}
                      </a>
                    )
                  })
                }
              </div>
            )
          })
        }
        </div>
      </div>
    )
  }
});

const Schedule = React.createClass({
  render() {
    let key = [0, 0];
    return (
      <div className="schedule">
      {
        this.props.schedule.map(function (day) {
          return (
            <div key={key[0]++}>
              <h3>{day.dayOfWeek}</h3>
              <table className="table table-hover">
              <thead>
                <tr>
                  <th>Время</th>
                  <th>Предмет</th>
                </tr>
              </thead>
              <tbody>
                {
                  day.lessons.map(function (lesson) {
                    return (
                      <tr key={key[1]++}>
                        <td>{lesson.time}</td>
                        <td>{lesson.name}</td>
                      </tr>
                    )
                  })
                }
              </tbody>
              </table>
            </div>
          )
        })
      }
      </div>
    )
  }
});

const Content = React.createClass({
  render() {
    return (
      <div className="container">
        {
          (this.props.mode === "start") ? <Start setScheduleState={this.props.setScheduleState} />:<Schedule schedule={this.props.schedule} />
        }
      </div>
    )
  }
});

const Page = React.createClass({
  getInitialState() {
    return {
      mode:"start",
      schedule:[]
    }
  },
  setScheduleState(schedule) {
    this.setState({
      mode:"schedule",
      schedule:schedule
    });
  },
  setStartState(str) {
    this.setState({
      mode:"start"
    });
  },
  render() {
    return (
      <div className="page">
        <Navbar setStartState={this.setStartState} />
        <Content mode={this.state.mode} setScheduleState={this.setScheduleState} schedule={this.state.schedule} />
      </div>
    )
  }
});

ReactDOM.render(
  <Page />,
  document.getElementById("main")
);
