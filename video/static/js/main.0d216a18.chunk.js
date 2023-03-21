(this.webpackJsonpvideo = this.webpackJsonpvideo || []).push([
    [0], {
        118: function(e, t, n) {
            e.exports = n(1238)
        },
        1204: function(e, t, n) {},
        1236: function(e, t, n) {},
        1238: function(e, t, n) {
            "use strict";
            n.r(t);
            var a = n(0),
                o = n.n(a),
                i = n(12),
                r = n.n(i),
                c = n(29),
                l = n(30),
                s = n(32),
                d = n(31),
                u = n(111),
                m = n(60),
                h = n.n(m),
                g = n(85),
                f = n(86),
                v = n.n(f),
                p = n(87),
                w = n.n(p),
                y = n(1260),
                b = n(1256),
                S = n(1257),
                E = n(1258),
                k = n(101),
                C = n.n(k),
                x = n(102),
                M = n.n(x),
                O = n(104),
                j = n.n(O),
                A = n(105),
                D = n.n(A),
                T = n(106),
                V = n.n(T),
                U = n(107),
                N = n.n(U),
                W = n(103),
                F = n.n(W),
                L = n(108),
                R = n.n(L),
                J = n(1259),
                P = (n(1202), n(1261)),
                B = n(35),
                H = (n(1203), n(1204), {}),
                I = {
                    iceServers: [{
                        urls: "stun:stun.l.google.com:19302"
                    }]
                },
                z = null,
                q = null,
                G = 0,
                Y = function(e) {
                    Object(s.a)(n, e);
                    var t = Object(d.a)(n);

                    function n(e) {
                        var a;
                        return Object(c.a)(this, n), (a = t.call(this, e)).getPermissions = Object(g.a)(h.a.mark((function e() {
                            return h.a.wrap((function(e) {
                                for (;;) switch (e.prev = e.next) {
                                    case 0:
                                        return e.prev = 0, e.next = 3, navigator.mediaDevices.getUserMedia({
                                            video: !0
                                        }).then((function() {
                                            return a.videoAvailable = !0
                                        })).catch((function() {
                                            return a.videoAvailable = !1
                                        }));
                                    case 3:
                                        return e.next = 5, navigator.mediaDevices.getUserMedia({
                                            audio: !0
                                        }).then((function() {
                                            return a.audioAvailable = !0
                                        })).catch((function() {
                                            return a.audioAvailable = !1
                                        }));
                                    case 5:
                                        navigator.mediaDevices.getDisplayMedia ? a.setState({
                                            screenAvailable: !0
                                        }) : a.setState({
                                            screenAvailable: !1
                                        }), (a.videoAvailable || a.audioAvailable) && navigator.mediaDevices.getUserMedia({
                                            video: a.videoAvailable,
                                            audio: a.audioAvailable
                                        }).then((function(e) {
                                            window.localStream = e, a.localVideoref.current.srcObject = e
                                        })).then((function(e) {})).catch((function(e) {
                                            return console.log(e)
                                        })), e.next = 12;
                                        break;
                                    case 9:
                                        e.prev = 9, e.t0 = e.catch(0), console.log(e.t0);
                                    case 12:
                                    case "end":
                                        return e.stop()
                                }
                            }), e, null, [
                                [0, 9]
                            ])
                        }))), a.getMedia = function() {
                            a.setState({
                                video: a.videoAvailable,
                                audio: a.audioAvailable
                            }, (function() {
                                a.getUserMedia(), a.connectToSocketServer()
                            }))
                        }, a.getUserMedia = function() {
                            if (a.state.video && a.videoAvailable || a.state.audio && a.audioAvailable) navigator.mediaDevices.getUserMedia({
                                video: a.state.video,
                                audio: a.state.audio
                            }).then(a.getUserMediaSuccess).then((function(e) {})).catch((function(e) {
                                return console.log(e)
                            }));
                            else try {
                                a.localVideoref.current.srcObject.getTracks().forEach((function(e) {
                                    return e.stop()
                                }))
                            } catch (e) {}
                        }, a.getUserMediaSuccess = function(e) {
                            try {
                                window.localStream.getTracks().forEach((function(e) {
                                    return e.stop()
                                }))
                            } catch (o) {
                                console.log(o)
                            }
                            window.localStream = e, a.localVideoref.current.srcObject = e;
                            var t = function(e) {
                                if (e === q) return "continue";
                                H[e].addStream(window.localStream), H[e].createOffer().then((function(t) {
                                    H[e].setLocalDescription(t).then((function() {
                                        z.emit("signal", e, JSON.stringify({
                                            sdp: H[e].localDescription
                                        }))
                                    })).catch((function(e) {
                                        return console.log(e)
                                    }))
                                }))
                            };
                            for (var n in H) t(n);
                            e.getTracks().forEach((function(e) {
                                return e.onended = function() {
                                    a.setState({
                                        video: !1,
                                        audio: !1
                                    }, (function() {
                                        try {
                                            a.localVideoref.current.srcObject.getTracks().forEach((function(e) {
                                                return e.stop()
                                            }))
                                        } catch (o) {
                                            console.log(o)
                                        }
                                        window.localStream = function() {
                                            var e;
                                            return new MediaStream([(e = a).black.apply(e, arguments), a.silence()])
                                        }(), a.localVideoref.current.srcObject = window.localStream;
                                        var e = function(e) {
                                            H[e].addStream(window.localStream), H[e].createOffer().then((function(t) {
                                                H[e].setLocalDescription(t).then((function() {
                                                    z.emit("signal", e, JSON.stringify({
                                                        sdp: H[e].localDescription
                                                    }))
                                                })).catch((function(e) {
                                                    return console.log(e)
                                                }))
                                            }))
                                        };
                                        for (var t in H) e(t)
                                    }))
                                }
                            }))
                        }, a.getDislayMedia = function() {
                            a.state.screen && navigator.mediaDevices.getDisplayMedia && navigator.mediaDevices.getDisplayMedia({
                                video: !0,
                                audio: !0
                            }).then(a.getDislayMediaSuccess).then((function(e) {})).catch((function(e) {
                                return console.log(e)
                            }))
                        }, a.getDislayMediaSuccess = function(e) {
                            try {
                                window.localStream.getTracks().forEach((function(e) {
                                    return e.stop()
                                }))
                            } catch (o) {
                                console.log(o)
                            }
                            window.localStream = e, a.localVideoref.current.srcObject = e;
                            var t = function(e) {
                                if (e === q) return "continue";
                                H[e].addStream(window.localStream), H[e].createOffer().then((function(t) {
                                    H[e].setLocalDescription(t).then((function() {
                                        z.emit("signal", e, JSON.stringify({
                                            sdp: H[e].localDescription
                                        }))
                                    })).catch((function(e) {
                                        return console.log(e)
                                    }))
                                }))
                            };
                            for (var n in H) t(n);
                            e.getTracks().forEach((function(e) {
                                return e.onended = function() {
                                    a.setState({
                                        screen: !1
                                    }, (function() {
                                        try {
                                            a.localVideoref.current.srcObject.getTracks().forEach((function(e) {
                                                return e.stop()
                                            }))
                                        } catch (o) {
                                            console.log(o)
                                        }
                                        window.localStream = function() {
                                            var e;
                                            return new MediaStream([(e = a).black.apply(e, arguments), a.silence()])
                                        }(), a.localVideoref.current.srcObject = window.localStream, a.getUserMedia()
                                    }))
                                }
                            }))
                        }, a.gotMessageFromServer = function(e, t) {
                            var n = JSON.parse(t);
                            e !== q && (n.sdp && H[e].setRemoteDescription(new RTCSessionDescription(n.sdp)).then((function() {
                                "offer" === n.sdp.type && H[e].createAnswer().then((function(t) {
                                    H[e].setLocalDescription(t).then((function() {
                                        z.emit("signal", e, JSON.stringify({
                                            sdp: H[e].localDescription
                                        }))
                                    })).catch((function(e) {
                                        return console.log(e)
                                    }))
                                })).catch((function(e) {
                                    return console.log(e)
                                }))
                            })).catch((function(e) {
                                return console.log(e)
                            })), n.ice && H[e].addIceCandidate(new RTCIceCandidate(n.ice)).catch((function(e) {
                                return console.log(e)
                            })))
                        }, a.changeCssVideos = function(e) {
                            var t = "30%";
                            30 * e.offsetWidth / 100 < 300 && (t = "300px");
                            var n = String(100 / G) + "%",
                                a = "";
                            0 === G || 1 === G ? (a = "100%", n = "100%") : 2 === G ? (a = "45%", n = "100%") : 3 === G || 4 === G ? (a = "35%", n = "50%") : a = String(100 / G) + "%";
                            for (var o = e.querySelectorAll("video:not(#my-video)"), i = 0; i < o.length; ++i) o[i].style.minWidth = t, o[i].style.minHeight = "40%", o[i].style.setProperty("width", a), o[i].style.setProperty("height", n);
                            return {
                                minWidth: t,
                                minHeight: "40%",
								borderRadius: "5px",
								backgrountColor: "#000",
                                width: a,
                                height: n
                            }
                        }, a.connectToSocketServer = function() {
                            (z = v.a.connect("https://video.sebastienbiollo.com", {
                                secure: !0
                            })).on("signal", a.gotMessageFromServer), z.on("connect", (function() {
                                z.emit("join-call", window.location.href), q = z.id, z.on("chat-message", a.addMessage), z.on("user-left", (function(e) {
                                    var t = document.querySelector('[data-socket="'.concat(e, '"]'));
                                    if (null !== t) {
                                        G--, t.parentNode.removeChild(t);
                                        var n = document.getElementById("main");
                                        a.changeCssVideos(n)
                                    }
                                })), z.on("user-joined", (function(e, t) {
                                    if (t.forEach((function(e) {
                                            if (H[e] = new RTCPeerConnection(I), H[e].onicecandidate = function(t) {
                                                    null != t.candidate && z.emit("signal", e, JSON.stringify({
                                                        ice: t.candidate
                                                    }))
                                                }, H[e].onaddstream = function(n) {
                                                    var o = document.querySelector('[data-socket="'.concat(e, '"]'));
                                                    if (null !== o) o.srcObject = n.stream;
                                                    else {
                                                        G = t.length;
                                                        var i = document.getElementById("main"),
                                                            r = a.changeCssVideos(i),
                                                            c = document.createElement("video"),
                                                            l = {
                                                                minWidth: r.minWidth,
                                                                minHeight: r.minHeight,
                                                                maxHeight: "100%",
                                                                objectFit: "fill"
                                                            };
                                                        for (var s in l) c.style[s] = l[s];
                                                        c.style.setProperty("width", r.width), c.style.setProperty("height", r.height), c.setAttribute("data-socket", e), c.srcObject = n.stream, c.autoplay = !0, c.playsinline = !0, i.appendChild(c)
                                                    }
                                                }, void 0 !== window.localStream && null !== window.localStream) H[e].addStream(window.localStream);
                                            else {
                                                window.localStream = function() {
                                                    var e;
                                                    return new MediaStream([(e = a).black.apply(e, arguments), a.silence()])
                                                }(), H[e].addStream(window.localStream)
                                            }
                                        })), e === q) {
                                        var n = function(e) {
                                            if (e === q) return "continue";
                                            try {
                                                H[e].addStream(window.localStream)
                                            } catch (t) {}
                                            H[e].createOffer().then((function(t) {
                                                H[e].setLocalDescription(t).then((function() {
                                                    z.emit("signal", e, JSON.stringify({
                                                        sdp: H[e].localDescription
                                                    }))
                                                })).catch((function(e) {
                                                    return console.log(e)
                                                }))
                                            }))
                                        };
                                        for (var o in H) n(o)
                                    }
                                }))
                            }))
                        }, a.silence = function() {
                            var e = new AudioContext,
                                t = e.createOscillator(),
                                n = t.connect(e.createMediaStreamDestination());
                            return t.start(), e.resume(), Object.assign(n.stream.getAudioTracks()[0], {
                                enabled: !1
                            })
                        }, a.black = function() {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                                t = e.width,
                                n = void 0 === t ? 640 : t,
                                a = e.height,
                                o = void 0 === a ? 480 : a,
                                i = Object.assign(document.createElement("canvas"), {
                                    width: n,
                                    height: o
                                });
                            i.getContext("2d").fillRect(0, 0, n, o);
                            var r = i.captureStream();
                            return Object.assign(r.getVideoTracks()[0], {
                                enabled: !1
                            })
                        }, a.handleVideo = function() {
                            return a.setState({
                                video: !a.state.video
                            }, (function() {
                                return a.getUserMedia()
                            }))
                        }, a.handleAudio = function() {
                            return a.setState({
                                audio: !a.state.audio
                            }, (function() {
                                return a.getUserMedia()
                            }))
                        }, a.handleScreen = function() {
                            return a.setState({
                                screen: !a.state.screen
                            }, (function() {
                                return a.getDislayMedia()
                            }))
                        }, a.handleEndCall = function() {
                            try {
                                a.localVideoref.current.srcObject.getTracks().forEach((function(e) {
                                    return e.stop()
                                }))
                            } catch (e) {}
                            window.location.href = ""
                        }, a.openChat = function() {
                            return a.setState({
                                showModal: !0,
                                newmessages: 0
                            })
                        }, a.closeChat = function() {
                            return a.setState({
                                showModal: !1
                            })
                        }, a.handleMessage = function(e) {
                            return a.setState({
                                message: e.target.value
                            })
                        }, a.addMessage = function(e, t, n) {
                            a.setState((function(n) {
                                return {
                                    messages: [].concat(Object(u.a)(n.messages), [{
                                        sender: t,
                                        data: e
                                    }])
                                }
                            })), n !== q && a.setState({
                                newmessages: a.state.newmessages + 1
                            })
                        }, a.handleUsername = function(e) {
                            return a.setState({
                                username: e.target.value
                            })
                        }, a.sendMessage = function() {
                            z.emit("chat-message", a.state.message, a.state.username), a.setState({
                                message: "",
                                sender: a.state.username
                            })
                        }, a.copyUrl = function() {
                            var e = window.location.href;
                            if (navigator.clipboard) navigator.clipboard.writeText(e).then((function() {
                                J.b.success("Link copied to clipboard!")
                            }), (function() {
                                J.b.error("Failed to copy")
                            }));
                            else {
                                var t = document.createElement("textarea");
                                t.value = e, document.body.appendChild(t), t.focus(), t.select();
                                try {
                                    document.execCommand("copy"), J.b.success("Link copied to clipboard!")
                                } catch (n) {
                                    J.b.error("Failed to copy")
                                }
                                document.body.removeChild(t)
                            }
                        }, a.connect = function() {
                            return a.setState({
                                askForUsername: !1
                            }, (function() {
                                return a.getMedia()
                            }))
                        }, a.isChrome = function() {
                            var e = (navigator && (navigator.userAgent || "")).toLowerCase(),
                                t = (navigator && (navigator.vendor || "")).toLowerCase();
                            return null !== (/google inc/.test(t) ? e.match(/(?:chrome|crios)\/(\d+)/) : null)
                        }, a.localVideoref = o.a.createRef(), a.videoAvailable = !1, a.audioAvailable = !1, a.state = {
                            video: !1,
                            audio: !1,
                            screen: !1,
                            showModal: !1,
                            screenAvailable: !1,
                            messages: [],
                            message: "",
                            newmessages: 0,
                            askForUsername: !0,
                            username: w.a.internet.userName()
                        }, H = {}, a.getPermissions(), a
                    }
                    return Object(l.a)(n, [{
                        key: "render",
                        value: function() {
                            var e = this;
                            return !1 === this.isChrome() ? o.a.createElement("div", {
                                style: {
                                    background: "white",
                                    width: "30%",
                                    height: "auto",
                                    padding: "20px",
                                    minWidth: "400px",
                                    textAlign: "center",
                                    margin: "auto",
                                    marginTop: "50px",
                                    justifyContent: "center"
                                }
                            }, o.a.createElement("h1", null, "Sorry, Alex Video works only with Google Chrome")) : o.a.createElement("div", null, !0 === this.state.askForUsername ? o.a.createElement("div", null, o.a.createElement("div", {
                                style: {
                                    background: "white",
                                    width: "30%",
                                    height: "auto",
                                    padding: "20px",
                                    minWidth: "400px",
                                    textAlign: "center",
                                    margin: "auto",
                                    marginTop: "50px",
                                    justifyContent: "center"
                                }
                            }, o.a.createElement("p", {
                                style: {
                                    margin: 0,
                                    fontWeight: "bold",
                                    paddingRight: "50px"
                                }
                            }, "Set your username"), o.a.createElement(y.a, {
                                placeholder: "Username",
                                id: "myusername",
                                onChange: function(t) {
                                    return e.handleUsername(t)
                                }
                            }), o.a.createElement(b.a, {
                                variant: "contained",
                                onClick: this.connect,
                                style: {
                                    margin: "20px",
									backgroundColor: "#1a73e8",
									color: "#FFF"
                                }
                            }, "Connect")), o.a.createElement("div", {
                                style: {
                                    justifyContent: "center",
                                    textAlign: "center",
                                    paddingTop: "40px"
                                }
                            }, o.a.createElement("video", {
                                id: "my-video",
                                ref: this.localVideoref,
                                autoPlay: !0,
                                muted: !0,
                                style: {
                                    objectFit: "fill"
                                }
                            }))) : o.a.createElement("div", null, o.a.createElement("div", {
                                className: "btn-down",
                                style: {
                                    backgroundColor: "white",
                                    color: "white",
                                    textAlign: "center"
                                }
                            }, o.a.createElement(S.a, {
                                style: {
                                    color: "#424242"
                                },
                                onClick: this.handleVideo
                            }, !0 === this.state.video ? o.a.createElement(C.a, null) : o.a.createElement(M.a, null)), o.a.createElement(S.a, {
                                style: {
                                    color: "#f44336"
                                },
                                onClick: this.handleEndCall
                            }, o.a.createElement(F.a, null)), o.a.createElement(S.a, {
                                style: {
                                    color: "#424242"
                                },
                                onClick: this.handleAudio
                            }, !0 === this.state.audio ? o.a.createElement(j.a, null) : o.a.createElement(D.a, null)), !0 === this.state.screenAvailable ? o.a.createElement(S.a, {
                                style: {
                                    color: "#424242"
                                },
                                onClick: this.handleScreen
                            }, 0 === this.state.screen ? o.a.createElement(V.a, null) : o.a.createElement(N.a, null)) : null, o.a.createElement(E.a, {
                                badgeContent: this.state.newmessages,
                                max: 999,
                                color: "#424242",
                                onClick: this.openChat,
								display: "none"
                            }, o.a.createElement(S.a, {
                                style: {
                                    color: "#424242",
									display: "none"
                                },
                                onClick: this.openChat
                            }, o.a.createElement(R.a, null)))), o.a.createElement(B.a, {
                                show: this.state.showModal,
                                onHide: this.closeChat,
                                style: {
                                    zIndex: "999999",
									display: "none"
                                }
                            }, o.a.createElement(B.a.Header, {
                                closeButton: !0
                            }, o.a.createElement(B.a.Title, null, "Alex Chat")), o.a.createElement(B.a.Body, {
                                style: {
                                    overflow: "auto",
                                    overflowY: "auto",
                                    height: "400px",
                                    textAlign: "left"
                                }
                            }, this.state.messages.length > 0 ? this.state.messages.map((function(e, t) {
                                return o.a.createElement("div", {
                                    key: t,
                                    style: {
                                        textAlign: "left"
                                    }
                                }, o.a.createElement("p", {
                                    style: {
                                        wordBreak: "break-all"
                                    }
                                }, o.a.createElement("b", null, e.sender), ": ", e.data))
                            })) : o.a.createElement("p", null, "No message yet")), o.a.createElement(B.a.Footer, {
                                className: "div-send-msg"
                            }, o.a.createElement(y.a, {
                                placeholder: "Message",
                                value: this.state.message,
                                onChange: function(t) {
                                    return e.handleMessage(t)
                                }
                            }), o.a.createElement(b.a, {
                                variant: "contained",
                                color: "#1a73e8",
								backgroundColor: "#1a73e8",
                                onClick: this.sendMessage
                            }, "Send"))), o.a.createElement("div", {
                                className: "container"
                            }, o.a.createElement("div", {
                                style: {
                                    paddingTop: "20px"
                                }
                            }, o.a.createElement(y.a, {
                                value: window.location.href,
                                disable: "true"
                            }), o.a.createElement(b.a, {
                                style: {
                                    backgroundColor: "#1a73e8",
                                    color: "white",
                                    marginLeft: "20px",
                                    marginTop: "10px",
                                    width: "120px",
                                    fontSize: "10px"
                                },
                                onClick: this.copyUrl
                            }, "Copy invite link")), o.a.createElement(P.a, {
                                id: "main",
                                className: "flex-container",
                                style: {
                                    margin: 0,
                                    padding: 0
                                }
                            }, o.a.createElement("video", {
                                id: "my-video",
                                ref: this.localVideoref,
                                autoPlay: !0,
                                muted: !0,
                                style: {
									position: "fixed",
									right: "100px",
									bottom: "100px",
                                    margin: "0px",
                                    width: "20%",
                                    height: "20%"
                                }
                            })))))
                        }
                    }]), n
                } (a.Component),
                $ = n(109),
                K = n.n($),
                Q = (n(1236), function(e) {
                    Object(s.a)(n, e);
                    var t = Object(d.a)(n);

                    function n(e) {
                        var a;
                        return Object(c.a)(this, n), (a = t.call(this, e)).handleChange = function(e) {
                            return a.setState({
                                url: e.target.value
                            })
                        }, a.join = function() {
                            if ("" !== a.state.url) {
                                var e = a.state.url.split("/");
                                window.location.href = "/".concat(e[e.length - 1])
                            } else {
                                e = Math.random().toString(36).substring(2, 7);
                                window.location.href = "/".concat(e)
                            }
                        }, a.state = {
                            url: ""
                        }, a
                    }
                    return Object(l.a)(n, [{
                        key: "render",
                        value: function() {}
                    }]), n
                }(a.Component)),
                X = n(110),
                Z = n(8),
                _ = function(e) {
                    Object(s.a)(n, e);
                    var t = Object(d.a)(n);

                    function n() {
                        return Object(c.a)(this, n), t.apply(this, arguments)
                    }
                    return Object(l.a)(n, [{
                        key: "render",
                        value: function() {
                            return o.a.createElement("div", null, o.a.createElement(X.a, null, o.a.createElement(Z.c, null, o.a.createElement(Z.a, {
                                path: "/",
                                exact: !0,
                                component: Q
                            }), o.a.createElement(Z.a, {
                                path: "/:url",
                                component: Y
                            }))))
                        }
                    }]), n
                }(a.Component);
            Boolean("localhost" === window.location.hostname || "[::1]" === window.location.hostname || window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));
            r.a.render(o.a.createElement(_, null), document.getElementById("root")), "serviceWorker" in navigator && navigator.serviceWorker.ready.then((function(e) {
                e.unregister()
            })).catch((function(e) {
                console.error(e.message)
            }))
        },
        153: function(e, t) {}
    },
    [
        [118, 1, 2]
    ]
]);