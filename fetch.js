// fetch('https://jsonplaceholder.typicode.com/todos/1')
// fetch('https://cmd.beta.thislife.com/json?method=moment.getDownloadLegacyVideosJobInfo')
//       .then((response) => response.json())
//       .then((json) => {
//         console.log(json);
//       })


      fetch('https://cmd.beta.thislife.com/json?method=moment.getDownloadLegacyVideosJobInfo', {
        method: 'POST',
        headers: {
            'Accept': 'application/json, text/javascript, */*; q=0.01',
            'Accept-Language': 'en-US,en;q=0.9',
            'Connection': 'keep-alive',
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: '{"method":"moment.getDownloadLegacyVideosJobInfo","params":["eyJraWQiOiJEQTl1OHh5OERQSnk5VU9kQkNWMGdEYk9RRWR1S24rS1l5R1RVZndEdlwvND0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiI1YjU4aWNscXZrcWxqYnQxcGQwZHVmc3NjZSIsInRva2VuX3VzZSI6ImFjY2VzcyIsInNjb3BlIjoidXJuOnNmbHk6bWVkaWFzZXJ2aWNlXC9yZWFkIHVybjpzZmx5OnBob3Rvc3NlcnZpY2VzXC9yZWFkIHVybjpzZmx5OnByZWZlcmVuY2VzXC91cGRhdGUgdXJuOnNmbHk6dXBsb2FkXC9jcmVhdGUgdXJuOnNmbHk6cGhvdG9zc2VydmljZXNcL3VwZGF0ZSB1cm46c2ZseTp1c2VyXC9yZWFkIHVybjpzZmx5OnBob3Rvc3NlcnZpY2VzXC9jcmVhdGUgdXJuOnNmbHk6cHJlZmVyZW5jZXNcL3JlYWQiLCJhdXRoX3RpbWUiOjE3MjEzMDMxNTAsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC51cy1lYXN0LTEuYW1hem9uYXdzLmNvbVwvdXMtZWFzdC0xXzJJd1VxVjFJZyIsImV4cCI6MTcyMTM4OTU1MCwiaWF0IjoxNzIxMzAzMTUwLCJ2ZXJzaW9uIjoyLCJqdGkiOiIxM2I3MmQwZS01YzE5LTRmYWYtODJlOC0yMjMzYjVlMjU3YWEiLCJjbGllbnRfaWQiOiI1YjU4aWNscXZrcWxqYnQxcGQwZHVmc3NjZSJ9.ZixAvHxCICQnvPigRZeLE0_4gsUbT8f-25JVXACzqLhg-ZQHILT4ZroD-2qNkKzcFHC8GpbV69w59U1uhOGHEOzmShnSXKQli34yjTRMu415YsKEjDbXLDQN8wzY8aw3ncCMSTG1kwhu-Op0y8pERIVF4PQ68J3irmfS7AJ5jXUec3Lb0EGe9hvD97vbk9lGcdW0SU1uYK7Ybpt51fSG18YLAykmFMPImWgelo50-Roi48IRYtptH2VWe-GjPZiyYyAN6FK0xgMuZGmX2vF7Zb5SscnRF0YxPGRDTKS0p2-GOf9X8mRiBSlQDRlFa_ufhz0UoSnfllbWebKQ5dWu8g","001059674647", "12345","legacy_video"],"headers":{"X-SFLY-SubSource":"library"},"id":null}'
    })
    .then((response) => response.json())
    .then((json) => {
        console.log(json);
    })
    