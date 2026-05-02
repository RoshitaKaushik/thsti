using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ThstiServer.Migrations
{
    /// <inheritdoc />
    public partial class AddResearchCenterTabs : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<string>(
                name: "AdmissionsContent",
                table: "ResearchCenter",
                type: "nvarchar(max)",
                nullable: true);

            migrationBuilder.AddColumn<string>(
                name: "CareersContent",
                table: "ResearchCenter",
                type: "nvarchar(max)",
                nullable: true);

            migrationBuilder.AddColumn<string>(
                name: "OverviewContent",
                table: "ResearchCenter",
                type: "nvarchar(max)",
                nullable: true);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "AdmissionsContent",
                table: "ResearchCenter");

            migrationBuilder.DropColumn(
                name: "CareersContent",
                table: "ResearchCenter");

            migrationBuilder.DropColumn(
                name: "OverviewContent",
                table: "ResearchCenter");
        }
    }
}
