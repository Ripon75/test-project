<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zoom Meeting</title>
    <script src="https://source.zoom.us/2.16.0/zoom-meeting-2.16.0.min.js"></script>
    <link rel="stylesheet" href="https://source.zoom.us/2.16.0/css/bootstrap.css" />
</head>
<body>
    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>

    <script>
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.16.0/lib', '/av');
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();

        document.addEventListener('DOMContentLoaded', function () {
            // Meeting configuration variables
            const meetConfig = {
                apiKey: "{{ env('ZOOM_API_KEY') }}",
                meetingNumber: 'YOUR_MEETING_ID',
                role: 0, // 0 for attendee, 1 for host
                userName: 'Laravel User',
                userEmail: 'user@example.com',
                passWord: 'YOUR_MEETING_PASSWORD', // optional
                signature: "{{ $signature }}", // generate using your backend
                sdkKey: "{{ env('ZOOM_API_KEY') }}"
            };

            // Join the meeting
            ZoomMtg.init({
                leaveUrl: 'http://localhost:8000',
                success: function () {
                    ZoomMtg.join({
                        meetingNumber: meetConfig.meetingNumber,
                        userName: meetConfig.userName,
                        signature: meetConfig.signature,
                        apiKey: meetConfig.apiKey,
                        userEmail: meetConfig.userEmail,
                        passWord: meetConfig.passWord,
                        success: function () {
                            console.log('Join meeting success');
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    </script>
</body>
</html>
