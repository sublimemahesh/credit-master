$(document).ready(function () {


    $('#industry').change(function () {
        var indId = $(this).val();
        $.ajax({
            url: "post-and-get/ajax/add-skill.php",
            type: "POST",
            data: {
                industry: indId,
                action: 'GETSKILLSBYINDUSTRY'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                var html = '<option> -- Please Select a Skill -- </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id + '">';
                    html += data.name;
                    html += '</option>';
                });
                $('#skill-bar').empty();
                $('#skill-bar').append(html);
            }
        });
    });

    $('#skill-bar').change(function () {
        var skillId = $(this).val();
        var memberId = $('#member').val();

        var skillName = $('#skill-bar option:selected').text();
        $.ajax({
            url: "post-and-get/ajax/add-skill.php",
            type: "POST",
            data: {
                skillId: skillId,
                memberId: memberId,
                action: 'CHECKSKILLISEXIST'
            },
            dataType: "JSON",
            success: function (JsonResult) {
                if (JsonResult.result === true) {

                    alert('You have already add ' + skillName + '  as your skill. Please select different skill to continue.');
                    $("#skill-bar option:selected").removeAttr("selected");
                    return false;

                }
            }
        });
    });
});

$(document).ajaxStart(function () {
    $('#loading').show();
});

$(document).ajaxComplete(function () {
    $('#loading').hide();
});
