using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace ThstiServer.Migrations
{
    /// <inheritdoc />
    public partial class AddCraftjsPageBuilder : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<bool>(
                name: "IsVisualBuilder",
                table: "Page",
                type: "bit",
                nullable: false,
                defaultValue: false);

            migrationBuilder.AddColumn<string>(
                name: "PageDataJson",
                table: "Page",
                type: "nvarchar(max)",
                nullable: true);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "IsVisualBuilder",
                table: "Page");

            migrationBuilder.DropColumn(
                name: "PageDataJson",
                table: "Page");
        }
    }
}
